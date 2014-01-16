<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class MinLengthValidator extends BaseValidator
{
    const message = 'simple_form.errors.min_length';

    public function validate($value, $formValues = array())
    {
        $minLen = trim($this->args);
        if(strlen($minLen) < 1 || preg_match('/[^0-9]/', $minLen))
        {
            trigger_error("Validator args is invalid: {$this->args}", E_USER_WARNING);
            return array(false, self::message);
        }

        $minLen = (int)$minLen;
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

        if($valueLength > 0 && $valueLength < $minLen)
        {
            return array(false, self::message);
        }

        return array(true, '');
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('minlength' => $len);
    }
}
