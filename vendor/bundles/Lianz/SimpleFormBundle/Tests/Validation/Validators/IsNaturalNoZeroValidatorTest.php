<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class IsNaturalNoZeroValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\IsNaturalNoZeroValidator();

        // valid
        list($valid, $error) = $validator->validate('1');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('123456789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        list($valid, $error) = $validator->validate('0');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.is_natural_no_zero', $error);

        list($valid, $error) = $validator->validate('-1');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.is_natural_no_zero', $error);

        list($valid, $error) = $validator->validate('-12345679');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.is_natural_no_zero', $error);

        list($valid, $error) = $validator->validate('+12345679');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.is_natural_no_zero', $error);

        list($valid, $error) = $validator->validate('12345.67890');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.is_natural_no_zero', $error);

        list($valid, $error) = $validator->validate('1234567890a');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.is_natural_no_zero', $error);
    }
}
