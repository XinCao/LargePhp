<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class AlphaValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\AlphaValidator();

        // tests
        list($valid, $error) = $validator->validate('abcdefhijklmnopqrstuvwxyz');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('abcdefhijklmnopqrstuvwxyz0123456789');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.alpha', $error);
    }
}
