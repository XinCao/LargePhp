<?php
namespace Lianz\SimpleFormBundle;

// <editor-fold defaultstate="collapsed" desc="use namespaces">


use InvalidArgumentException;
use Lianz\SimpleFormBundle\Constants;
use Lianz\SimpleFormBundle\Validation\ProcessorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
// </editor-fold>

class Form extends ParameterBag
{
    private $formName;
    private $csrfFieldName;

    private $isValid            = true;
    private $validated          = false;
    private $autoRestoreForm    = false;
    private $csrfEnabled        = false;

    private $rawFieldValues        = array();
    private $fieldDefinitions   = array();

    private $errors             = array();
    private $validateResult       = array();
    private $renderedFields     = array();

    private $container;
    private $validator;
    private $processor;

    public function __construct(ContainerInterface $container, $autoRestoreForm = null, $formName = null)
    {
        parent::__construct(array());

        $this->container = $container;
        $this->validator = $container->get('simple_form.validator');
        $this->processor = $container->get('simple_form.processor');

        if(null === $autoRestoreForm)
        {
            $autoRestoreParameterName = 'simple_form.settings.auto_restore_form';
            if($container->hasParameter($autoRestoreParameterName))
            {
                $this->autoRestoreForm = (bool)$container->getParameter($autoRestoreParameterName);
            }
        }
        else
        {
            $this->autoRestoreForm = (bool)$autoRestoreForm;
        }

        if(!$formName)
        {
            $request   = $container->get('request');
            $routeName = $request->get('_route');
            $formName  = "_simple_form:{$routeName}";
        }
        $this->formName  = $formName;

        // SimpleForm CSRF function depends on CSRF settings of Core Framework
        $csrfParameterName = 'form.type_extension.csrf.enabled';
        if($container->hasParameter($csrfParameterName))
        {
            $this->csrfEnabled   = (bool)$container->getParameter($csrfParameterName);
            $this->csrfFieldName = $this->container->getParameter('form.type_extension.csrf.field_name');
        }
    }

    public function init(array $fieldDefs = array())
    {
        foreach ($fieldDefs as $fieldName => $fieldInfo)
        {
            $validators    = isset($fieldInfo[0])  ? $fieldInfo[0] : array();
            $preprocessors = !isset($fieldInfo[1]) ? array('trim') : (array)$fieldInfo[1];

            $this->addFieldRaw($fieldName, $validators, $preprocessors);
        }

        $this->restoreForm();
        $this->populateValidateResult();

        return $this;
    }

    public function clear()
    {
        foreach ($this->all() as $key => $value)
        {
            $this->remove($key);
        }

        $this->isValid            = true;
        $this->validated          = false;

        $this->errors             = array();
        $this->validateResult       = array();
        $this->renderedFields     = array();

        // clear saved form data from session
        if($this->autoRestoreForm)
        {
            $session = $this->container->get('session');
            $session->remove($this->formName);
        }

        return $this;
    }

    protected function restoreForm()
    {
        // try auto restore form form previous saved form data
        if($this->autoRestoreForm)
        {
            $session = $this->container->get('session');
            $prevFormData = $session->get($this->formName);
            if(is_array($prevFormData) && $prevFormData)
            {
                $this->bind($prevFormData);
            }
        }
    }

    protected function saveForm($fieldValues)
    {
        // auto save form data to session
        if($this->autoRestoreForm)
        {
            // will not save CSRF field
            if($this->csrfEnabled)
            {
                unset($fieldValues[$this->csrfFieldName]);
            }

            $session = $this->container->get('session');
            $session->set($this->formName, $fieldValues);
        }
    }

    /**
     * add a CSRF field if csrf is enabled and the form does not have one
     */
    private function addCsrfField()
    {
        if($this->csrfEnabled)
        {
            if(isset($this->fieldDefinitions[$this->csrfFieldName]))
            {
                return;
            }

            $this->addFieldRaw($this->csrfFieldName, array('valid_csrf'), array());

            $csrfProvider = $this->container->get('form.csrf_provider');
            $csrfToken    = $csrfProvider->generateCsrfToken(Constants::SIMPLE_FORM_INTENTION);
            $this->set($this->csrfFieldName, $csrfToken);
        }
    }

    public function addField($fieldName, $validators)
    {
        $preprocessors = array('trim');
        return $this->addFieldRaw($fieldName, $validators, $preprocessors);
    }

    public function addFieldRaw($fieldName, $validators, $preprocessors)
    {
        if(isset($this->fieldDefinitions[$fieldName]))
        {
            throw new InvalidArgumentException("Duplicated field: {$fieldName}");
        }

        if(is_string($validators))
        {
            $validators = preg_split('/\s*,\s*/', $validators);
            $validators = array_filter($validators);
        }

        if(is_string($preprocessors))
        {
            $preprocessors = preg_split('/\s*,\s*/', $preprocessors);
            $preprocessors = array_filter($preprocessors);
        }

        $this->fieldDefinitions[$fieldName] = array($validators, $preprocessors);

        return $this;
    }

    public function registerValidator($validatorName, $validatorInfo)
    {
        $this->validator->register($validatorName, $validatorInfo);

        return $this;
    }

    public function registerProcessor($processorName, $processorCallable)
    {
        $this->processor->register($processorName, $processorCallable);

        return $this;
    }

    public function bind($keyValues)
    {
        $this->addCsrfField();

        if($keyValues instanceOf ParameterBag)
        {
            $keyValues = $keyValues->all();
        }
        if(!is_array($keyValues))
        {
            throw \InvalidArgumentException('Parameter $keyValues expected an Array or an instance of Symfony\Component\HttpFoundation\ParameterBag');
        }

        $this->rawFieldValues = array();
        
        $processedFieldValues = $this->processor->process($keyValues, $this->fieldDefinitions);

        foreach($processedFieldValues as $fieldName => $value)
        {
            if(isset($this->fieldDefinitions[$fieldName]))
            {
                $this->set($fieldName, $value);

                if(isset($keyValues[$fieldName]))
                {
                    $this->rawFieldValues[$fieldName] = $keyValues[$fieldName];
                }
            }
        }

        $this->saveForm($this->rawFieldValues);
        $this->populateValidateResult();

        return $this;
    }

    public function validate($revalidate = false)
    {
        if($revalidate)
        {
            $this->validated = false;
        }

        if(!$this->validated)
        {
            $this->validated = true;
            list($valid, $errors) = $this->validator->validate($this->all(), $this->fieldDefinitions);
            if(!$valid)
            {
                $this->errors = $errors;
            }

            $this->populateValidateResult();
            $this->isValid = (bool)$valid;
        }

        return $this->isValid;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getFieldDefinitions()
    {
        return $this->fieldDefinitions;
    }

    public function getFieldValues()
    {
        return $this->rawFieldValues;
    }

    private function populateValidateResult()
    {
        foreach ($this->fieldDefinitions as $fieldName => $def)
        {
            $error = isset($this->errors[$fieldName]) ? $this->errors[$fieldName] : null;
            list($validators, $_) = $def;
            $value     = $this->get($fieldName, '');
            $rawValue  = isset($this->rawFieldValues[$fieldName]) ? $this->rawFieldValues[$fieldName] : null;
            $required  = in_array('required', $validators);
            $fieldData = array('name' => $fieldName, 'value' => $value, 'raw_value' => $rawValue, 'error' => $error, 'form' => $this, 'required' => $required);

            $this->validateResult[$fieldName] = $fieldData;
        }
    }

    public function __call($fieldName, $arguments)
    {
        if(!isset($this->validateResult[$fieldName]))
        {
            throw new InvalidArgumentException("Property {$fieldName} does not exist.");
        }

        $fieldInfo = $this->validateResult[$fieldName];

        return $fieldInfo;
    }

    public function setRendered($fieldName, $rendered = true)
    {
        $this->renderedFields[$fieldName] = $rendered;
    }

    public function getUnrenderedFields()
    {
        $rest = array();
        foreach ($this->validateResult as $key => $value)
        {
            if(!isset($this->renderedFields[$key]))
            {
                $rest[$key] = $value;
            }
        }

        return $rest;
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function generateRules($fieldNames = array())
    {
        $jsRules = $this->validator->generateJQueryValidateRules($this->fieldDefinitions, $fieldNames);
        return $jsRules;
    }
}
