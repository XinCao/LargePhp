<?php
namespace Lianz\SimpleFormBundle\Validation;

interface ValidatorInterface
{
    public function validate($value, $formValues = array());
    public function toJQueryValidateRule();
}
