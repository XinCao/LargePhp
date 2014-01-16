<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class LessThanValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        // valid
        $validator = new Validators\LessThanValidator('99');
        list($valid, $error) = $validator->validate('98');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        $validator = new Validators\LessThanValidator('100');
        list($valid, $error) = $validator->validate('99');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        $validator = new Validators\LessThanValidator('15');
        list($valid, $error) = $validator->validate('20');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.less_than', $error);
    }
}
