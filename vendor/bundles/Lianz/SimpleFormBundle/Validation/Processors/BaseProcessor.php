<?php
namespace Lianz\SimpleFormBundle\Validation\Processors;

use Lianz\SimpleFormBundle\Validation\ProcessorInterface;

abstract class BaseProcessor implements ProcessorInterface
{
    public abstract function process($value, $args = null, $formValues = array());
}
