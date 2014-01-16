<?php
namespace DreamHeaven\AdminBundle\Form\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 *@abstract 构建编辑帐号的表单
 */
class EditAccountForm extends AbstractType {

    protected $options;

    public function __construct($options = array()) {
        $this->options = $options;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('display_name', 'text', array('label' => "真实姓名", 'required' => true))
                ->add('old_password', 'password', array('label' => "旧密码", 'required' => false, 'always_empty' => false))
                ->add('new_password', 'repeated', array('label' => '请输入新密码', 'required' => false, 'type' => 'password', //'invalid_message'   => '两次输入的密码不相同', 
                'options' => array('label' => '新密码','always_empty' => false),))->getForm();
    }
    
    public function getName() {
        return 'account_form';
    }
}
