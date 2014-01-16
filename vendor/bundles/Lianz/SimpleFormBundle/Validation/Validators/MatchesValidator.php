<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

class MatchesValidator extends BaseValidator
{
    const message = 'simple_form.errors.matches';

    public function validate($value, $formValues = array())
    {
        $matchField = trim($this->args);
        if(!$matchField || !isset($formValues[$matchField]))
        {
            trigger_error("Match field is invalid: {$matchField}", E_USER_WARNING);
            return array(false, self::message);
        }

        if($value !== $formValues[$matchField])
        {
            return array(false, self::message);
        }

        return array(true, '');
    }

    public function toJQueryValidateRule()
    {
        $target = $this->args;
        return array('equalTo' => $target);
    }
}
