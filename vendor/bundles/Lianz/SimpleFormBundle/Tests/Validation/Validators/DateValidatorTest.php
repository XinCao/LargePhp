<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class DateValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\DateValidator();

        // invaid tests
        list($valid, $error) = $validator->validate('2012-12-12');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('2012/12/12');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('2012.12.12');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // ininvaid tests
        list($valid, $error) = $validator->validate('2012-12-aa');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date', $error);

        list($valid, $error) = $validator->validate('2012/!2/12');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date', $error);

        list($valid, $error) = $validator->validate('201o.12.12');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date', $error);

        list($valid, $error) = $validator->validate('./*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date', $error);
    }
}
