<?php
namespace DreamHeaven\AdminBundle\Validation\Processors;

use DreamHeaven\AdminBundle\Service\GmService;
use Lianz\SimpleFormBundle\Validation\Processors\BaseProcessor;

class MultiRealmProcessor extends BaseProcessor
{
    private $realms;

    public function __construct(GmService $gmService)
    {
        $this->realms = $gmService->getAllRealms();
    }

    public function process($realmIds, $args = null, $formValues = array())
    {
        $filteredServerList = array_filter($this->realms, function($s) use($realmIds) { return in_array($s['realm'], $realmIds); });

        $ok = !(empty($filteredServerList) || empty($realmIds) || count($filteredServerList) !== count($realmIds));
        if(!$ok)
        {
            return null;
        }

        return $filteredServerList;
    }
}
