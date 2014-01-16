<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

use Lianz\SimpleFormBundle\Validation\ValidatorInterface;

abstract class BaseValidator implements ValidatorInterface
{
    protected $args    = null;

    public function __construct($args = null)
    {
        $this->args = $args;
    }

    abstract public function validate($value, $formValues = array());

    public function toJQueryValidateRule()
    {
        return null;
    }
}
