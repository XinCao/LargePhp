<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class AlphaNumericValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\AlphaNumericValidator();

        // tests
        list($valid, $error) = $validator->validate('abcdefhijklmno01234pqrstuvwxyz56789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('_abcdefhijklmno01234pqrstuvwxyz56789');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.alpha_numeric', $error);
    }
}
