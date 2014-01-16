<?php

namespace DreamHeaven\AdminBundle\Controller\Security;

use DreamHeaven\AdminBundle\Controller\BaseController;
use RuntimeException;
use Symfony\Component\Security\Core\SecurityContext;

class SessionController extends BaseController {

    public function loginAction() {
        $session = $this->session;
        $requestAttrs = $this->request->attributes;
        if ($requestAttrs->has(SecurityContext::AUTHENTICATION_ERROR)) {  // get the error if any (works with forward and redirect -- see below)
            $error = $requestAttrs->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        $errorMessage = null;
        if ($error instanceOf \Exception && ($errorKey = $this->getErrorKey($error))) {
            $errorMessage = $this->translateError($errorKey);
        }
        $viewdata = array('last_username' => $session->get(SecurityContext::LAST_USERNAME), 'error' => $errorMessage);
        $response = $this->renderResponse('DreamHeavenAdminBundle:Security/Session:login', $viewdata);
        return $response;
    }

    /**
     * 
     * @return String 错误的键值
     */
    protected function getErrorKey($error) {
        $classFullName = get_class($error); // 返回对象的类名
        $pos = strrpos($classFullName, '\\'); // 从后向前，第一次匹配的位置
        $className = substr($classFullName, $pos + 1); // 从字符串中取出子串
        $exceptionName = substr($className, 0, strlen($className) - strlen('Exception'));
        if (!$exceptionName) {
            return null;
        }
        $exceptionCname = preg_replace_callback('([A-Z])', function($m) {
                    return strtolower('_' . $m[0]);
                }, $exceptionName); // 匹配正则表达式，并通过回调函数进行替换
        $exceptionCname = trim($exceptionCname, '_'); // 去掉字符串两边指定的字符
        return $exceptionCname;
    }

    /**
     * 
     * @abstract String 翻译错误键值
     */
    protected function translateError($errorKey) {
        $transKey = "authentication.errors.{$errorKey}";
        $translator = $this->get('translator');
        $translated = $translator->trans($transKey, array(), 'errors');
        return $translated;
    }

    public function accessDeniedAction() {
        $response = $this->renderResponse('DreamHeavenAdminBundle:Security/Session:accessDenied', array());
        return $response;
    }

    public function loginCheckAction() {
        throw new RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction() {
        throw new RuntimeException('You must activate the logout in your security firewall configuration.');
    }

}