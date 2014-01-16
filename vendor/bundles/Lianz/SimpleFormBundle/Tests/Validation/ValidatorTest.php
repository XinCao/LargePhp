<?php
namespace Lianz\SimpleFormBundle\Tests\Validators;

use Lianz\SimpleFormBundle\Validation\Validator;
use Lianz\SimpleFormBundle\Validation\Registry;
use Lianz\SimpleFormBundle\Constants;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    var $validator;
    public function setUp()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');

        $valueMap = array(
            array('simple_form.validators.buildins.required.class',    'Lianz\SimpleFormBundle\Validation\Validators\RequiredValidator'),
            array('simple_form.validators.buildins.alpha.class',       'Lianz\SimpleFormBundle\Validation\Validators\AlphaValidator'),
            array('simple_form.validators.buildins.min_length.class',  'Lianz\SimpleFormBundle\Validation\Validators\MinLengthValidator'),
            array('simple_form.validators.buildins.max_length.class',  'Lianz\SimpleFormBundle\Validation\Validators\MaxLengthValidator'),
            array('simple_form.validators.buildins.valid_email.class', 'Lianz\SimpleFormBundle\Validation\Validators\ValidEmailValidator'),
            array('simple_form.validators.buildins.matches.class',     'Lianz\SimpleFormBundle\Validation\Validators\MatchesValidator'),
        );

        $container->expects($this->any())
            ->method('getParameter')
            ->will($this->returnValueMap($valueMap));

        $container->expects($this->any())
            ->method('hasParameter')
            ->will($this->returnCallback(function($arg)use($valueMap){
                    foreach($valueMap as $value)
                    {
                        if($value[0] == $arg)
                        {
                            return true;
                        }
                    }
                    return false;
                })
            );

        $this->validator = new Validator($container);
    }

    public function testRegister()
    {
        $registry = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        $this->assertFalse($registry->has('non-existance-key'));

        $this->validator->register('custom_validator_1', function($value){return true;});

        $this->assertTrue($registry->has('custom_validator_1'));
        $this->assertTrue(is_callable($registry->get('custom_validator_1')));
    }

    public function testValidate()
    {
        $fieldDefs  = array(
            'username'  => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'nickname'  => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'firstname' => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'lastname'  => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'email'     => array(preg_split('/\s*,\s*/', 'required, valid_email'), null),
            'password1' => array(preg_split('/\s*,\s*/', 'required, min_length[6], max_length[100]'), null),
            'password2' => array(preg_split('/\s*,\s*/', 'required, min_length[6], max_length[100], matches[password1]'), null),
        );

        // valid
        $formValues = array(
            'username'  => 'lianz',
            'nickname'  => 'LiANZ',
            'firstname' => 'Liang',
            'lastname'  => 'Zhenjing',
            'email'     => 'liangzhenjing@gmail.com',
            'password1' => 'abc123456',
            'password2' => 'abc123456',
        );

        list($valid, $errors) = $this->validator->validate($formValues, $fieldDefs);
        $this->assertTrue($valid);
        $this->assertEmpty($errors);

        // invalid
        $formValues = array(
            'username'  => '',
            'nickname'  => 'invalid_name!',
            'firstname' => 'Lia',
            'lastname'  => 'Zhenjingthisnameistoolooooooooong',
            'email'     => 'liangzhenjing*invalid@gmail.com',
            'password1' => 'abc123456',
            'password2' => 'qwertyuio',
        );

        list($valid, $errors) = $this->validator->validate($formValues, $fieldDefs);
        $this->assertFalse($valid);
        $this->assertEquals('simple_form.errors.required',    $errors['username']);
        $this->assertEquals('simple_form.errors.alpha',       $errors['nickname']);
        $this->assertEquals('simple_form.errors.min_length',  $errors['firstname']);
        $this->assertEquals('simple_form.errors.max_length',  $errors['lastname']);
        $this->assertEquals('simple_form.errors.valid_email', $errors['email']);
        $this->assertEquals('simple_form.errors.matches',     $errors['password2']);
    }
}
