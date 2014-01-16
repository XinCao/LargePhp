<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class LessThanValidator extends BaseValidator
{
    const message = 'simple_form.errors.less_than';

    public function validate($value, $formValues = array())
    {
        $compareTarget = trim($this->args);
        if(strlen($value) > 0 && $value > $compareTarget)
        {
            return array(false, self::message);
        }

        return array(true, '');
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('max' => $len);
    }
}
