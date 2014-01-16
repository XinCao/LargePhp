<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class DecimalValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\DecimalValidator();

        // tests
        list($valid, $error) = $validator->validate('1234567890.1234');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('-1234567890.1234');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('+1234567890.1234');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('1234567890');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.decimal', $error);

        list($valid, $error) = $validator->validate('1234567890.1234.45');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.decimal', $error);

        list($valid, $error) = $validator->validate('a12345-67890.1234');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.decimal', $error);
    }
}
