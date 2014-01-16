<?php
namespace Lianz\SimpleFormBundle;

use Lianz\SimpleFormBundle\Validation\Validator;
use Lianz\SimpleFormBundle\Validation\Processor;
use Lianz\SimpleFormBundle\Validation\Registry;
use Lianz\SimpleFormBundle\Constants;

class FormTest extends \PHPUnit_Framework_TestCase
{
    /** @var Lianz\SimpleFormBundle\Form */
    var $form;
    var $fieldDefs  = array(
            'username'  => array('required, alpha, min_length[5], max_length[20]', null),
            'nickname'  => array('required, alpha, min_length[5], max_length[20]', null),
            'firstname' => array('required, alpha, min_length[5], max_length[20]', null),
            'lastname'  => array('required, alpha, min_length[5], max_length[20]', null),
            'email'     => array('required, valid_email', null),
            'password1' => array('required, min_length[6], max_length[100]', null),
            'password2' => array('required, min_length[6], max_length[100], matches[password1]', null),
            'intro'     => array('', null),
        );
    var $validFormValues = array(
            'username'  => 'lianz',
            'nickname'  => 'LiANZ',
            'firstname' => 'Liang',
            'lastname'  => 'Zhenjing',
            'email'     => 'liangzhenjing@gmail.com',
            'password1' => 'abc123456',
            'password2' => 'abc123456',

            'extra_value1' => 'just a value',
            'extra_value2' => 'just another value',
    );

    var $invalidFormValues = array(
            'username'  => '',
            'nickname'  => 'invalid_name!',
            'firstname' => 'Lia',
            'lastname'  => 'Zhenjingthisnameistoolooooooooong',
            'email'     => 'liangzhenjing*invalid@gmail.com',
            'password1' => 'abc123456',
            'password2' => 'qwertyuio',

            'extra_value1' => 'just a value',
            'extra_value2' => 'just another value',
    );

    public function setUp()
    {
        $requestValueMap = array(
            array('_route', 'test'),
        );
        $requestMock = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $requestMock->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap($requestValueMap));

        $this->containerMock = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');

        $serviceValueMap = array(
            array('request',                1, $requestMock),
            array('simple_form.validator',  1, new Validator($this->containerMock)),
            array('simple_form.processor',  1, new Processor($this->containerMock)),
        );

        $parameterValueMap = array(
            array('simple_form.validators.buildins.required.class',    'Lianz\SimpleFormBundle\Validation\Validators\RequiredValidator'),
            array('simple_form.validators.buildins.alpha.class',       'Lianz\SimpleFormBundle\Validation\Validators\AlphaValidator'),
            array('simple_form.validators.buildins.min_length.class',  'Lianz\SimpleFormBundle\Validation\Validators\MinLengthValidator'),
            array('simple_form.validators.buildins.max_length.class',  'Lianz\SimpleFormBundle\Validation\Validators\MaxLengthValidator'),
            array('simple_form.validators.buildins.valid_email.class', 'Lianz\SimpleFormBundle\Validation\Validators\ValidEmailValidator'),
            array('simple_form.validators.buildins.matches.class',     'Lianz\SimpleFormBundle\Validation\Validators\MatchesValidator'),
        );

        $this->containerMock->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap($serviceValueMap));

        $this->containerMock->expects($this->any())
            ->method('getParameter')
            ->will($this->returnValueMap($parameterValueMap));

        $this->containerMock->expects($this->any())
            ->method('hasParameter')
            ->will($this->returnCallback(function($arg)use($parameterValueMap){
                    foreach($parameterValueMap as $value)
                    {
                        if($value[0] == $arg)
                        {
                            return true;
                        }
                    }
                    return false;
                })
            );
    }

    public function testInit()
    {
        $form = new Form($this->containerMock);
        $form->init($this->fieldDefs);

        $defs = $form->getFieldDefinitions();

        $this->assertEquals(preg_split('/\s*,\s*/', $this->fieldDefs['username'][0]),  $defs['username'][0]);
        $this->assertEquals(preg_split('/\s*,\s*/', $this->fieldDefs['nickname'][0]),  $defs['nickname'][0]);
        $this->assertEquals(preg_split('/\s*,\s*/', $this->fieldDefs['firstname'][0]), $defs['firstname'][0]);
        $this->assertEquals(preg_split('/\s*,\s*/', $this->fieldDefs['lastname'][0]),  $defs['lastname'][0]);
        $this->assertEquals(preg_split('/\s*,\s*/', $this->fieldDefs['email'][0]),     $defs['email'][0]);
        $this->assertEquals(preg_split('/\s*,\s*/', $this->fieldDefs['password1'][0]), $defs['password1'][0]);
        $this->assertEquals(preg_split('/\s*,\s*/', $this->fieldDefs['password2'][0]), $defs['password2'][0]);
    }

    public function testAddField()
    {
        $form = new Form($this->containerMock);
        $form->addField('username', 'required');
        $defs = $form->getFieldDefinitions();

        $this->assertEquals(array('required'), $defs['username'][0]);
        $this->assertEquals(array('trim'), $defs['username'][1]);
    }

    public function testAddFieldRaw()
    {
        $form = new Form($this->containerMock);
        $form->addFieldRaw('username', 'required', array('ltrim'));
        $defs = $form->getFieldDefinitions();

        $this->assertEquals(array('required'), $defs['username'][0]);
        $this->assertEquals(array('ltrim'), $defs['username'][1]);
    }

    public function testRegisterValidator()
    {
        $callable = function($value){return true;};
        $form = new Form($this->containerMock);
        $form->registerValidator('custom_validator_1', $callable);

        $registry = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);
        $validator = $registry->get('custom_validator_1');

        $this->assertSame($callable, $validator);
    }

    public function testBind()
    {
        $form = new Form($this->containerMock);
        $form->init($this->fieldDefs);
        $form->bind($this->validFormValues);

        $formValues = $form->getFieldValues();
        $expectedFormValues = $this->validFormValues;
        unset($expectedFormValues['extra_value1'], $expectedFormValues['extra_value2']);

        $this->assertEquals($expectedFormValues, $formValues);
    }

    public function testValidate()
    {
        // valid
        $form = new Form($this->containerMock);
        $form->init($this->fieldDefs);
        $form->bind($this->validFormValues);
        $valid = $form->validate();
        $this->assertTrue($valid);

        // valid
        $form = new Form($this->containerMock);
        $form->init($this->fieldDefs);
        $form->bind($this->invalidFormValues);
        $valid = $form->validate();
        $errors = $form->getErrors();

        $this->assertFalse($valid);
        $this->assertEquals('simple_form.errors.required',    $errors['username']);
        $this->assertEquals('simple_form.errors.alpha',       $errors['nickname']);
        $this->assertEquals('simple_form.errors.min_length',  $errors['firstname']);
        $this->assertEquals('simple_form.errors.max_length',  $errors['lastname']);
        $this->assertEquals('simple_form.errors.valid_email', $errors['email']);
        $this->assertEquals('simple_form.errors.matches',     $errors['password2']);
    }
}
