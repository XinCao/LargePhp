<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class MaxLengthValidator extends BaseValidator
{
    const message = 'simple_form.errors.max_length';

    public function validate($value, $formValues = array())
    {
        $maxLen = trim($this->args);
        if(strlen($maxLen) < 1 || preg_match('/[^0-9]/', $maxLen))
        {
            trigger_error("Match field is invalid: {$matchField}", E_USER_WARNING);
            return array(false, self::message);
        }

        $maxLen = (int)$maxLen;
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

        if($valueLength > $maxLen)
        {
            return array(false, self::message);
        }

        return array(true, '');
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('maxlength' => $len);
    }
}
