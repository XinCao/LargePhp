<?php
namespace Lianz\SimpleFormBundle\Validation;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
use Lianz\SimpleFormBundle\Constants;
use Lianz\SimpleFormBundle\Helper\ValidationHelper;
use Lianz\SimpleFormBundle\Validation\ProcessorInterface;
use Lianz\SimpleFormBundle\Validation\Registry;
use Symfony\Component\DependencyInjection\ContainerInterface;
// </editor-fold>

class Processor
{
    private $container = null;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function register($processorName, $callable)
    {
        $registry = Registry::getRegistry(Constants::CUSTOM_PROCESSORS);
        $registry->set($processorName, $callable);
    }

    public function process($formValues, $fieldDefinitions)
    {
        $allValid = true;
        $errors = array();

        foreach ($fieldDefinitions as $fieldName => $fieldDef)
        {
            $value = isset($formValues[$fieldName]) ? $formValues[$fieldName] : null;
            list($_, $processors) = $fieldDef;
            if($processors)
            {
                $value = $this->processField($formValues, $fieldName, $value, $processors);
                $formValues[$fieldName] = $value;
            }
        }

        return $formValues;
    }

    private function processField($formValues, $fieldName, $value, $processors)
    {
        foreach ($processors as $processorInfo)
        {
            list($processor, $processorArgs) = ValidationHelper::parseProcessor($this->container, $processorInfo);

            if(is_callable($processor))
            {
                $value = call_user_func($processor, $value);
            }
            elseif($processor instanceOf ProcessorInterface)
            {
                $value = $processor->process($value, $processorArgs, $formValues);
            }
            else
            {
                trigger_error("Processor Info is invalid: {$processorInfo}", E_USER_WARNING);
            }
        }

        return $value;
    }
}
