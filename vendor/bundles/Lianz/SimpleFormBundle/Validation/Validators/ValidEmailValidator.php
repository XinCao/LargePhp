<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class ValidEmailValidator extends RegexValidator
{
    const message = 'simple_form.errors.valid_email';

    public function __construct()
    {
        $this->args = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i";
    }

    public function validate($value, $formValues = array())
    {
        return parent::validate($value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return array('email' => true);
    }
}
