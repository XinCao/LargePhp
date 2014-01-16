<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class NumericValidator extends BaseValidator
{
    const message = 'simple_form.errors.numeric';

    public function validate($value, $formValues = array())
    {
        $result = (strlen($value) < 1 || is_numeric($value)) ? array(true, '') : array(false, self::message);
        return $result;
    }

    public function toJQueryValidateRule()
    {
        return array('number' => true);
    }

}
