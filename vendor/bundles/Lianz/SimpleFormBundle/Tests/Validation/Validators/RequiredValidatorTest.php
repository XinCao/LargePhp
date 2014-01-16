<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class RequiredValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\RequiredValidator();

        // valid
        list($valid, $error) = $validator->validate('0');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('1');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('str');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('!@#$%');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('+123456789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('123456789.123456');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('5.556E+9');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        list($valid, $error) = $validator->validate('');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.required', $error);

        list($valid, $error) = $validator->validate(null);
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.required', $error);

        list($valid, $error) = $validator->validate(false);
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.required', $error);
    }
}
