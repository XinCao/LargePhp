<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class AlphaValidator extends RegexValidator
{
    const message = 'simple_form.errors.alpha';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-z]+$/i';
    }

    public function validate($value, $formValues = array())
    {
        return parent::validate($value, $formValues);
    }
}
