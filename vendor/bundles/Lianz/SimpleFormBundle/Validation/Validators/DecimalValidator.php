<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class DecimalValidator extends RegexValidator
{
    const message = 'simple_form.errors.decimal';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[\-+]?[0-9]+\.[0-9]+$/';
    }

    public function validate($value, $formValues = array())
    {
        return parent::validate($value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return array('number' => true, 'regex' => $this->jsPattern);
    }
}
