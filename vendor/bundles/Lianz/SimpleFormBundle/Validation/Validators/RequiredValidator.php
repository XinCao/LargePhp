<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class RequiredValidator extends BaseValidator
{
    const message = 'simple_form.errors.required';

    public function validate($value, $formValues = array())
    {
        if((is_string($value) && strlen($value) > 0))
        {
            return array(true, '');
        }

        return $value ? array(true, '') : array(false, self::message);
    }

    public function toJQueryValidateRule()
    {
        return array('required' => true);
    }

}
