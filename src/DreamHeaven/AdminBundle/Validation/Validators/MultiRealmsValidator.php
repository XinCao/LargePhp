<?php
namespace DreamHeaven\AdminBundle\Validation\Validators;

use DreamHeaven\AdminBundle\Service\GmService;
use Lianz\SimpleFormBundle\Validation\Validators\BaseValidator;


class MultiRealmsValidator extends BaseValidator
{
    private $realms;
    const message = 'admin_bundle.validator_errors.realm';

    public function __construct(GmService $gmService)
    {
        $this->realms = $gmService->getAllRealms();
    }

    public function validate($realms, $formValues = array())
    {
        $valid = $this->isValid($realms);

        return $valid ? array(true, '') : array(false, self::message);
    }

    public function isValid($realms)
    {
        if(!$realms)
        {
            return false;
        }

        $realmIds = array();
        foreach ($realms as $realm)
        {
            $realmIds[] = $realm['realm'];
        }

        $filteredRealms = array_filter($this->realms, function($s) use($realmIds) { return in_array($s['realm'], $realmIds); });

        $valid = !(empty($filteredRealms ) || count($filteredRealms ) !== count($realms));
        return $valid;
    }
}
