<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class ValidDateValidator extends RegexValidator
{
    const message = 'simple_form.errors.valid_date';

    public function __construct()
    {
        $this->args = '/^\d\d\d\d[-\/\.]\d\d[-\/\.]\d\d$/';
    }

    public function validate($value, $formValues = array())
    {
        return parent::validate($value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return array('date' => true, 'regex' => $this->args);
    }
}
