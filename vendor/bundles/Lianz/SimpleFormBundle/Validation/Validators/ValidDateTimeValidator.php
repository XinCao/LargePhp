<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class ValidDateTimeValidator extends RegexValidator
{
    const message = 'simple_form.errors.date_time';

    public function __construct()
    {
        $this->args = '/^\d\d\d\d[-\/\.]\d\d[-\/\.]\d\d \d\d:\d\d:\d\d$/i';
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
