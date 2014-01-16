<?php
namespace DreamHeaven\AdminBundle\Validation\Validators;

use Lianz\SimpleFormBundle\Validation\Validators\BaseValidator;

class ItemNumValidator extends BaseValidator
{
    const message = 'admin_bundle.validator_errors.item_num';

    public function validate($num, $formValues = array())
    {
        $itemIdField = "item_id{$this->args}";
        $itemId = isset($formValues[$itemIdField]) ? $formValues[$itemIdField] : null;
        $valid = ($itemId && $num) || (!$itemId && !$num);

        return $valid ? array(true, '') : array(false, self::message);
    }
}
