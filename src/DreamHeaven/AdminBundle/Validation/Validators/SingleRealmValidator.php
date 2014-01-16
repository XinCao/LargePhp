<?php
namespace DreamHeaven\AdminBundle\Validation\Validators;

use DreamHeaven\AdminBundle\Service\GmService;
use Lianz\SimpleFormBundle\Validation\Validators\BaseValidator;

class SingleRealmValidator extends BaseValidator
{
    private $realms;
    const message = 'admin_bundle.validator_errors.single_realm';

    public function __construct(GmService $gmService)
    {
        $this->realms = $gmService->getAllRealms();
    }

    public function validate($realm, $formValues = array())
    {
        if($realm === 'ALL')
        {
            $valid = true;
        }
        else
        {
            $valid = isset($realm['id']) && isset($this->realms[$realm['id']]);
        }

        return $valid ? array(true, '') : array(false, self::message);
    }
}
