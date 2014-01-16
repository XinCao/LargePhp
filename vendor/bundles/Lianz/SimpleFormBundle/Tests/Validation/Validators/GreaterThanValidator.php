<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class GreaterThanValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {

        // valid
        $validator = new Validators\GreaterThanValidator('98');
        list($valid, $error) = $validator->validate('99');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        $validator = new Validators\GreaterThanValidator('99');
        list($valid, $error) = $validator->validate('100');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        $validator = new Validators\GreaterThanValidator('20');
        list($valid, $error) = $validator->validate('15');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.greater_than', $error);
    }
}
