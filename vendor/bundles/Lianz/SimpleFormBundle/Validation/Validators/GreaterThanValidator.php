<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class GreaterThanValidator extends BaseValidator
{
    const message = 'simple_form.errors.greater_than';

    public function validate($value, $formValues = array())
    {
        $compareTarget = trim($this->args);
        if(strlen($value) > 0 && (!is_numeric($value) || !is_numeric($compareTarget) || $value < $compareTarget))
        {
            return array(false, self::message);
        }

        return array(true, '');
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('min' => $len);
    }
}
