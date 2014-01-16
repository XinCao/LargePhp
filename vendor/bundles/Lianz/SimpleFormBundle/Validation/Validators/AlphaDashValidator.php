<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class AlphaDashValidator extends RegexValidator
{
    const message = 'simple_form.errors.alpha_dash';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-z0-9_-]+$/i';
    }

    public function validate($value, $formValues = array())
    {
        return parent::validate($value, $formValues);
    }
}
