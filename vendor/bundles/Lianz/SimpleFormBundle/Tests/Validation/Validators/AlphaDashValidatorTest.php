<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class AlphaDashValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\AlphaDashValidator();

        // tests
        list($valid, $error) = $validator->validate('_abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('./*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.alpha_dash', $error);
    }
}
