<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class MatchesValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $password = uniqid('test_password_', true);

        $formValues = array('password' => $password, 'password_confirm' => $password);

        $validator = new Validators\MatchesValidator('password');

        // valid
        list($valid, $error) = $validator->validate($formValues['password_confirm'],$formValues);
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
        list($valid, $error) = $validator->validate($formValues['password_confirm'],$formValues);
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.matches', $error);

        try
        {
            // test 3
            $validator = new Validators\MatchesValidator('non-existance-field');

            $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
            list($valid, $error) = $validator->validate($formValues['password_confirm'], $formValues);
            $this->assertFalse($valid);
            $this->assertNotEmpty($error);
            $this->assertEquals('simple_form.errors.matches', $error);
        }
        catch (\PHPUnit_Framework_Error_Warning $ex)
        {
            return;
        }

        $this->fail('Test 3 shoud raise an E_USER_WARNING error.');
    }
}
