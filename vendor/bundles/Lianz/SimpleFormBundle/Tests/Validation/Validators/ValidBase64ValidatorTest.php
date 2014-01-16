<?php
namespace Lianz\SimpleFormBundle\Tests\Validation\Validators;

use Lianz\SimpleFormBundle\Tests\ValidatorTestCase;
use Lianz\SimpleFormBundle\Validation\Validators;

class ValidBase64Validator extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new Validators\ValidBase64Validator();

        // valid
        list($valid, $error) = $validator->validate('ZnVjayBjcGMhIQo=');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        list($valid, $error) = $validator->validate('5Zyf5YWx5b+F5LqhCg==');
        $this->assertTrue($valid);
        $this->assertEmpty($error);

        // invalid
        list($valid, $error) = $validator->validate('!@#');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.valid_base64', $error);

        list($valid, $error) = $validator->validate('$%^&*');
        $this->assertFalse($valid);
        $this->assertNotEmpty($error);
        $this->assertEquals('simple_form.errors.valid_base64', $error);
    }
}
