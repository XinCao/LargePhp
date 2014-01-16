<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class RegexValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        // valid
        $validator = new Validators\RegexValidator('');
        list($valid, $error) = $validator->validate('');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        $validator = new Validators\RegexValidator('/[a-z]+/');
        list($valid, $error) = $validator->validate('abcdefghijklmnopqrstuvwxyz');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        $validator = new Validators\RegexValidator('/[0-9]+/');
        list($valid, $error) = $validator->validate('0123456789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        $validator = new Validators\RegexValidator('/[a-z]+/');
        list($valid, $error) = $validator->validate('0123456789');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.regex', $error);

        $validator = new Validators\RegexValidator('/[a-z]+/');
        list($valid, $error) = $validator->validate('!@#$');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.regex', $error);
    }
}
