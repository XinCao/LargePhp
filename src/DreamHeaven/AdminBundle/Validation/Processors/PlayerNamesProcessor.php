<?php
namespace DreamHeaven\AdminBundle\Validation\Processors;

use Lianz\SimpleFormBundle\Validation\Processors\BaseProcessor;

class PlayerNamesProcessor extends BaseProcessor
{
    public function process($playerNamesStr, $args = null, $formValues = array())
    {
        $playerNamesStr = str_replace(",", ' ', $playerNamesStr);
        $playerIds = array_filter(preg_split('/\s+/', $playerNamesStr));
        return $playerIds;
    }
}
