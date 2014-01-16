<?php
namespace Lianz\SimpleFormBundle\Validation\Processors;

class SplitProcessor extends BaseProcessor
{
    public function process($value, $args = null, $formValues = array())
    {
        return preg_split("/{$args}/", $value);
    }
}
