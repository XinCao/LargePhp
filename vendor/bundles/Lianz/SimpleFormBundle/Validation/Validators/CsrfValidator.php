<?php
namespace Lianz\SimpleFormBundle\Validation\Validators;

use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface;
use Lianz\SimpleFormBundle\Constants;
use Lianz\SimpleFormBundle\Validation\ValidatorInterface;

class CsrfValidator implements ValidatorInterface
{
    const message = 'simple_form.errors.valid_csrf';

    /** @var CsrfProviderInterface */
    private $csrfProvider;
    public function __construct($csrfProvider)
    {
        $this->csrfProvider = $csrfProvider;
    }

    public function validate($token, $formValues = array())
    {
        $valid = $this->csrfProvider->isCsrfTokenValid(Constants::SIMPLE_FORM_INTENTION, $token);
        $result = $valid ? array(true, '') : array(false, self::message);
        return $result;
    }

    public function toJQueryValidateRule()
    {
        return null;
    }
}
