<?php
namespace Lianz\SimpleFormBundle\Validation\Processors;

class ReplaceProcessor extends BaseProcessor
{
    public function process($value, $args = null, $formValues = array())
    {
        preg_replace($pattern, $replacement, $subject);
        return preg_split("/{$args}/", $value);
    }
}
