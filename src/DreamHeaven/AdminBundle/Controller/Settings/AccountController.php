<?php

namespace DreamHeaven\AdminBundle\Controller\Settings;

use DreamHeaven\AdminBundle\Form\Settings\EditAccountForm;
use DreamHeaven\CoreBundle\Controller\BaseController;
use Symfony\Component\Form\FormError;

class AccountController extends BaseController {

    /**
     * 
     * @abstract 设置帐号表单
     */
    public function editAction() {
        $form = $this->getEditAccountForm();
        $viewData = array('form' => $form->createView(), 'user' => $this->getUser());
        $response = $this->renderResponse('DreamHeavenAdminBundle:Settings:editAccount', $viewData);
        return $response;
    }

    /**
     * 
     * @abstract 设置帐号
     */
    public function updateAction() {
        $form = $this->getEditAccountForm();
        $form->bindRequest($this->request);
        if ($this->request->getMethod() == 'POST') {
            $data = $form->getData();
            $user = $this->getUser();
            $oldPassword = $data['old_password'];
            if ($oldPassword && !$this->isOldPasswordCorrect($user, $oldPassword)) {
                $oldField = $form->get('old_password');
                $oldField->addError(new FormError('请输入正确的旧密码'));
            } elseif ($form->isValid()) {
                $user->setDisplayName($data['display_name']);
                $userManager = $this->get('fos_user.user_manager');
                if ($oldPassword && $data['new_password']) {
                    $user->setPlainPassword($data['new_password']);
                    $userManager->updatePassword($user);
                }
                $userManager->updateUser($user);
                $this->addFlash('success', '保存帐号成功');
                $url = $this->generateUrl('admin_settings_account_edit', array(), true);
                return $this->redirect($url);
            }
        }
        $viewData = array('form' => $form->createView(), 'user' => $this->getUser());
        $response = $this->renderResponse('DreamHeavenAdminBundle:Settings:editAccount', $viewData);
        return $response;
    }

    /**
     * 
     * @abstract 构造表单对象
     */
    private function getEditAccountForm() {
        $form = $this->createForm(new EditAccountForm());
        return $form;
    }

    /**
     * 
     * @abstract 验证用户密码
     * @param User 对象
     * @param String 密码
     * @return boolean
     */
    private function isOldPasswordCorrect($user, $password) {
        $encoderService = $this->get('security.encoder_factory');
        $encoder = $encoderService->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($password, $user->getSalt());
        return $encodedPassword == $user->getPassword();
    }

}