<?php
namespace DreamHeaven\AdminBundle\Validation\Validators;

use Lianz\SimpleFormBundle\Validation\Validators\BaseValidator;

class PlayerIdsValidator extends BaseValidator
{
    const message = 'admin_bundle.validator_errors.player_ids';

    public function validate($playerIds, $formValues = array())
    {
        $playerNames = isset($formValues['player_names']) ? (array)$formValues['player_names'] : array();
        $valid = $playerIds && $playerNames && count($playerIds) == count($playerNames);

        return $valid ? array(true, '') : array(false, self::message);
    }
}
