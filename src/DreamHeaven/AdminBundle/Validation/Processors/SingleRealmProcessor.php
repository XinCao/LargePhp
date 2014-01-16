<?php
namespace DreamHeaven\AdminBundle\Validation\Processors;

use DreamHeaven\AdminBundle\Service\GmService;
use Lianz\SimpleFormBundle\Validation\Processors\BaseProcessor;

class SingleRealmProcessor extends BaseProcessor
{
    private $realms;

    public function __construct(GmService $gmService)
    {
        $this->realms = $gmService->getAllRealms();
    }

    public function process($realmId, $args = null, $formValues = array())
    {
        if($realmId == 'ALL')
        {
            return 'ALL';
        }

        $realm = isset($this->realms[$realmId]) ? $this->realms[$realmId] : null;
        return $realm;
    }
}
