<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class MinLengthValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\MinLengthValidator('9');

        // valid
        list($valid, $error) = $validator->validate(''); // 空字符串是合法的
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('123456789');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('abcdefghi');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('不多不少正好九个字');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('中英混合words');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('超过九个字也是ok的');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        // invalid args
        list($valid, $error) = $validator->validate('6chars');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.min_length', $error);

        list($valid, $error) = $validator->validate('12345');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.min_length', $error);

        list($valid, $error) = $validator->validate('不到九个fail');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.min_length', $error);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testValidateFailed_1()
    {
        $validator = new Validators\MinLengthValidator('');
        list($valid, $error) = $validator->validate('6chars');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.min_length', $error);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testValidateFailed_2()
    {
        $validator = new Validators\MinLengthValidator('a123');
        list($valid, $error) = $validator->validate('6chars');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.min_length', $error);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error_Warning
     */
    public function testValidateFailed_3()
    {
        $validator = new Validators\MinLengthValidator('23*');
        list($valid, $error) = $validator->validate('6chars');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.min_length', $error);
    }
}
