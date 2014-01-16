<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class ExactLengthValidator extends BaseValidator
{
    const message = 'simple_form.errors.exact_length';

    public function validate($value, $formValues = array())
    {
        $len = trim($this->args);
        if(strlen($len) < 1 || preg_match('/[^0-9]/', $len))
        {
            trigger_error("Invalid length argument: {$len}", E_USER_WARNING);
            return array(false, self::message);
        }

        $len = (int)$len;
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

        if($valueLength !== $len)
        {
            return array(false, self::message);
        }

        return array(true, '');
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('range' => array($len, $len));
    }
}
