<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class RegexValidator extends BaseValidator
{
    const message = 'simple_form.errors.regex';

    protected $jsPattern = '';

    public function validate($value, $formValues = array())
    {
        if(is_string($value) && strlen($value) < 1)
        {
            return array(true, '');
        }

        $regex = trim($this->args);
        if(strlen($regex) < 1)
        {
            trigger_error("Invalid regex: {$regex}", E_USER_WARNING);
            return array(false, static::message);
        }

        if(strlen($value) > 0 && !preg_match($regex, $value))
        {
            return array(false, static::message);
        }

        return array(true, '');
    }

    public function toJQueryValidateRule()
    {
        $jsPattern = trim($this->jsPattern);

        if(strlen($jsPattern) < 1)
        {
            return null;
        }
//
//        $delimiter = $jsPattern[0];
//        $pos = stripos($jsPattern, $delimiter);
//        $pattern = substr($jsPattern, 0, $pos);
//        $modifiers = substr($jsPattern, $pos);

        return array('regex' => $jsPattern);
    }
}
