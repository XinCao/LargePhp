<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class DateTimeValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\DateTimeValidator();

        // invaid tests
        list($valid, $error) = $validator->validate('2012-12-12 11:11:11');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('2012/12/12 11:11:11');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('2012.12.12 11:11:11');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // ininvaid tests
        list($valid, $error) = $validator->validate('2012-12-12-11:11:11');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date_time', $error);

        list($valid, $error) = $validator->validate('2012/12 11:11:11');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date_time', $error);

        list($valid, $error) = $validator->validate('2012.12.12 11:11:qq');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date_time', $error);

        list($valid, $error) = $validator->validate('./*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.date_time', $error);
    }
}
