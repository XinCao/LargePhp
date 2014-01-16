<?php
namespace DreamHeaven\AdminBundle\Form\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints as C;
//use Symfony\Component\Validator\Constraints\MinLength;
//use Symfony\Component\Validator\Constraints\Collection;

/**
 * @abstract 暂时未使用的表单类
 */
class EditProfileForm extends AbstractType {
    protected $options;
    
    public function __construct($options = array()) {
        $this->options = $options;
    }

    public function buildForm(FormBuilder $builder, array $options) {
        $nameMin = $this->options['name_min'];
        $nameMax = $this->options['name_max'];
//      $builder->add('name',   'text', array('label'  => "名字（{$nameMin}-{$nameMax} 个字符）", 'property_path' => 'children[name]'))
        $builder->add('name',   'text', array('label'  => "名字（{$nameMin}-{$nameMax} 个字符）", 'error_bubbling' => false))
                ->add('gender', 'choice', array(
                    'label'     => '性别',
                    'choices'   => array('x' => '保密', 'm' => '男生', 'f' => '女生'),
                    'required'  => false, 'error_bubbling' => false,
                ))
                ->add('birthday', 'birthday', array(
                    'label'  => '生日（格式: 1999-9-9）',
                    'widget' => 'single_text',
                    'input'  => 'string',
//                  'format' => 'yyyy-MM-dd',
//                  'invalid_message' => '生日格式错误',
                    'required'  => false, 'error_bubbling' => false,
                ))
                ->add('city', 'text', array('label' => '所在城市', 'required'  => false,))
                ->add('school', 'text', array('label' => '毕业院校', 'required'  => false,))
                ->add('intro', 'textarea', array('label' => '自我介绍', 'required'  => false,))
                ->getForm();;
    }

    public function getDefaultOptions(array $options) {
        $pattern = $this->options['pattern'];
        $collectionConstraint = new C\Collection(array(
            'name'     => new C\Regex(array('pattern' => $pattern, 'message' => '名字格式不符合要求')),
        ));

        $collectionConstraint->allowExtraFields = true;
        return array('validation_constraint' => $collectionConstraint,);
    }

    public function getName() {
        return "profile_form";
    }
}
