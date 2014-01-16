<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class ValidEmailValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\ValidEmailValidator();

        // valid
        list($valid, $error) = $validator->validate('test@example.com');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('test_123@example.com');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('test-123@example.com');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('test-123@subdomain.subdomain.example.com');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        list($valid, $error) = $validator->validate('test!@example.com');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.valid_email', $error);

        list($valid, $error) = $validator->validate('test@ex!ample.com');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.valid_email', $error);
    }
}
