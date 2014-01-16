<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class IsNaturalValidator extends RegexValidator
{
    const message = 'simple_form.errors.is_natural';

    public function __construct()
    {
        $this->args = '/^[0-9]+$/';
    }

    public function validate($value, $formValues = array())
    {
        return parent::validate($value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return array('number' => true, 'min' => 0, 'digits' => true);
    }
}
