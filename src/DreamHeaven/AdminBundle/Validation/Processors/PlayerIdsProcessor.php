<?php
namespace DreamHeaven\AdminBundle\Validation\Processors;

use Lianz\SimpleFormBundle\Validation\Processors\BaseProcessor;

class PlayerIdsProcessor extends BaseProcessor
{
    public function process($playerIdsStr, $args = null, $formValues = array())
    {
        $playerIdsStr = str_replace(",", ' ', $playerIdsStr);
        $playerIds = array_filter(preg_split('/\s+/', $playerIdsStr));
        return $playerIds;
    }
}
