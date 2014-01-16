<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class MaxLengthValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\MaxLengthValidator('9');

        // valid
        list($valid, $error) = $validator->validate('');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('12345');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('123456789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('abcdefghi');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('6chars');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('不多不少正好九个字');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('中英混合words');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        list($valid, $error) = $validator->validate('1234567890');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.max_length', $error);

        list($valid, $error) = $validator->validate('123456789_');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.max_length', $error);

        list($valid, $error) = $validator->validate('超过九个字会fail');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.max_length', $error);

        list($valid, $error) = $validator->validate('这肯定超过九个字了吧？？');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.max_length', $error);
    }
}
