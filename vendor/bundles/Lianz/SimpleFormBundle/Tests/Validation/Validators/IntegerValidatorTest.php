<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class IntegerValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\IntegerValidator();

        // valid
        list($valid, $error) = $validator->validate('012346789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('-012346789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('+012346789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        list($valid, $error) = $validator->validate('0.123456789');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.integer', $error);

        list($valid, $error) = $validator->validate('12345.67890');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.integer', $error);

        list($valid, $error) = $validator->validate('1234567890a');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.integer', $error);
    }
}
