<?php
namespace Lianz\SimpleFormBundle\Validation;

interface ProcessorInterface
{
    public function process($value, $args = null, $formValues = array());
}
