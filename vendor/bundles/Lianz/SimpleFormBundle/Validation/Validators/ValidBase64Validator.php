<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class ValidBase64Validator extends RegexValidator
{
    const message = 'simple_form.errors.valid_base64';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-zA-Z0-9\/\+=]*$/';
    }

    public function validate($value, $formValues = array())
    {
        if(strlen($value) === 0)
        {
            return array(true, '');
        }
        else
        {
            list($valid, $_) = parent::validate($value, $formValues);
            $result = $valid ? array(true, '') : array(false, self::message);
            return $result;
        }
    }
}
