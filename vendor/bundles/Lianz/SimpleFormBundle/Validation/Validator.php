<?php
namespace Lianz\SimpleFormBundle\Validation;

// <editor-fold defaultstate="collapsed" desc="use namespaces">


use Lianz\SimpleFormBundle\Constants;
use Lianz\SimpleFormBundle\Helper\ValidationHelper;
use Lianz\SimpleFormBundle\Validation\Registry;
use Symfony\Component\DependencyInjection\ContainerInterface;
// </editor-fold>

class Validator
{
    private $container = null;
    private $jsRules   = null;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function register($validatorName, $callable)
    {
        $registry = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);
        $registry->set($validatorName, $callable);
    }

    public function validate($formValues, $fieldDefinitions)
    {
        $allValid = true;
        $errors = array();

        foreach ($fieldDefinitions as $fieldName => $fieldDef)
        {
            $value = isset($formValues[$fieldName]) ? $formValues[$fieldName] : null;
            list($validators, $_) = $fieldDef;
            if($validators)
            {
                list($fieldValid, $errorMessage) = $this->validateField($formValues, $fieldName, $value, $validators);
                if(!$fieldValid)
                {
                    $allValid = false;
                    $errors[$fieldName] = $errorMessage;
                }
            }
        }

        return array($allValid, $errors);
    }

    private function validateField($formValues, $fieldName, $value, $validators)
    {
        $fieldValid   = true;
        $errorMessage = null;

        foreach ($validators as $validatorInfo)
        {
            list($validator, $validatorArgs) = ValidationHelper::parseValidator($this->container, $validatorInfo);

            if(is_callable($validator))
            {
                list($succeed, $errorMessage) = call_user_func($validator, $value, $validatorArgs, $formValues);
            }
            elseif($validator instanceOf ValidatorInterface)
            {
                list($succeed, $errorMessage) = $validator->validate($value, $formValues);
            }
            else
            {
                trigger_error("Validator Info is invalid: {$validatorInfo}", E_USER_WARNING);
            }

            if(!$succeed)
            {
                $fieldValid = false;
                break;
            }
        }

        return array($fieldValid, $errorMessage);
    }


    public function generateJQueryValidateRules($fieldDefinitions, $fieldNames = array())
    {
        if(null !== $this->jsRules)
        {
            return $this->jsRules;
        }

        $this->jsRules = array();

        $fieldNames = $fieldNames ?: array_keys($fieldDefinitions);
        foreach ($fieldNames as $fieldName)
        {
            if(!isset($fieldDefinitions[$fieldName]))
            {
                trigger_error("Undefined field: {$fieldName}", E_USER_WARNING);
                continue;
            }

            $fieldDef = $fieldDefinitions[$fieldName];
            list($validatorInfos, $_) = $fieldDef;
            if(is_string($validatorInfos))
            {
                $validatorInfos = preg_split('/\s*,\s*/', $validatorInfos);
            }

            $fieldRules = array();
            foreach ($validatorInfos as $info)
            {
                list($validator, $args) = ValidationHelper::parseValidator($this->container, $info);
                if(!($validator instanceOf ValidatorInterface))
                {
                    continue;
                }

                $rule = $validator->toJQueryValidateRule();
                if($rule)
                {
                    $fieldRules = array_merge($fieldRules, $rule);
                }
            }

            if($fieldRules)
            {
                $this->jsRules[$fieldName] = $fieldRules;
            }
        }

        return $this->jsRules;
    }
}
