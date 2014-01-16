<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class IsNaturalNoZeroValidator extends RegexValidator
{
    const message = 'simple_form.errors.is_natural_no_zero';

    public function __construct()
    {
        $this->args = '/^[0-9]+$/';
    }

    public function validate($value, $formValues = array())
    {
        $result = (strlen($value) > 0 && 0 === (int)$value) ? array(false, self::message) : parent::validate($value, $formValues);
        return $result;
    }

    public function toJQueryValidateRule()
    {
        return array('number' => true, 'min' => 1, 'digits' => true);
    }
}
