<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class AlphaNumericValidator extends RegexValidator
{
    const message = 'simple_form.errors.alpha_numeric';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-z0-9]+$/i';
    }

    public function validate($value, $formValues = array())
    {
        return parent::validate($value, $formValues);
    }
}
