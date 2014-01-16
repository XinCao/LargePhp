<?php

namespace DreamHeaven\AdminBundle\Controller\GameMaster;

use DreamHeaven\Component\Http\Exception\NotFoundHttpException;
use DreamHeaven\AdminBundle\Controller\BaseController;
use Symfony\Component\Security\Core\Role\Role;

class UserManagementController extends BaseController {

    public function indexAction() {
        $limit = min($this->GET->getInt('count', 20), 100);
        $offset = max($this->GET->getInt('start', 0), 0);

        $doctrine = $this->getDoctrine();
        $conn = $doctrine->getConnection();
        $sql = "select id, username, email, display_name, enabled, last_login, roles from users ORDER BY enabled DESC, id ASC LIMIT {$limit} OFFSET {$offset};";
        $stmt = $conn->query($sql);
        $userInfos = array();

        $allRoles = $this->getRoles();
        while ($stmt && $userInfo = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $roles = @unserialize($userInfo['roles']);

            if (is_array($roles)) {
                $roleNames = array();
                foreach ($roles as $role) {
                    $roleNames[] = isset($allRoles[$role]) ? $allRoles[$role] : $role;
                }

                $userInfo['roles'] = join(', ', $roleNames);
            }

            $userInfos[] = $userInfo;
        }

        $viewData = array('users' => $userInfos);
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/UserManagement:index', $viewData);
        return $response;
    }

    public function newAction() {
        $data = array();
        $data['user_roles'] = $this->getRoles(true);
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/UserManagement:new', $data);
        return $response;
    }

    public function createAction() {
        list($isValid, $user, $data) = $this->getAndValidateFormData();
        if (!$isValid) {
            $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/UserManagement:new', $data);
            return $response;
        }

        $this->saveUser($user, $data);

        $this->addFlash('success', '用户创建成功');

        $redirUrl = $this->generateUrl('admin_game_master_user_management_index');
        return $this->redirect($redirUrl);
    }

    public function editAction($id) {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        if (!$user) {
            throw new NotFoundHttpException("没有找到 ID 为 {$id} 的用户");
        }

        $data = $user->toArray('id', 'username', 'display_name', 'enabled', 'roles');
        $data['user_roles'] = $this->getRoles(true);
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/UserManagement:edit', $data);
        return $response;
    }

    protected function getRoles($currentUserOnly = false) {
        static $avaliableRoles = array(
    'ROLE_SUPER_ADMIN' => '超级管理员',
//            'ROLE_ADMIN'         => '管理员',
    'ROLE_MANAGER' => '经理',
    'ROLE_GM' => 'GM',
    'ROLE_REPORT_VIEWER' => '运营报表',
        );

        $user = $this->getUser();
        if (!$currentUserOnly || $user->hasRole('ROLE_SUPER_ADMIN')) {
            return $avaliableRoles;
        } else {
            $allowedRoles = array();
            foreach ($user->getRoles() as $roleName) {
                if (isset($avaliableRoles[$roleName])) {
                    $allowedRoles[$roleName] = $avaliableRoles[$roleName];
                }
            }

            return $allowedRoles;
        }
    }

    public function updateAction($id) {
        list($isValid, $user, $data) = $this->getAndValidateFormData($id);
        if (!$isValid) {
            $data['id'] = $id;
            $data['_avaliable_roles'] = $this->getRoles();
            $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/UserManagement:edit', $data);
            return $response;
        }

        if (!$user) {
            throw new NotFoundHttpException("没有找到 ID 为 {$id} 的用户");
        }

        $this->saveUser($user, $data);
        $this->addFlash('success', '用户保存成功');

        $redirUrl = $this->generateUrl('admin_game_master_user_management_index');
        return $this->redirect($redirUrl);
    }

    protected function saveUser($user, $data) {
        $email = isset($data['email']) ? $data['email'] : "{$data['username']}@tmp.abcwave.com";
        $user->setEmail($email);

        $user->setUsername($data['username']);
        $user->setDisplayName($data['display_name']);
        $user->setEnabled($data['enabled']);

        if ($data['password']) {
            $user->setPlainPassword($data['password']);
        }

        if ($data['roles'] && is_array($data['roles'])) {
            $validRoles = $this->getUser()->getRoles();

            //获得角色实例对象数组
            $roles = array();
            foreach ($data['roles'] as $validRole) {
                $roles[] = new Role($validRole);
            }
            $roleHierarchy = $this->get("security.role_hierarchy");
            $reachableRoles = $roleHierarchy->getReachableRoles($roles);

            //把角色实例转化为字符串数组
            $finalRoles = array();
            foreach ($reachableRoles as $reachableRole) {
                $roleName = $reachableRole->getRole();
                if (!in_array($roleName, $finalRoles)) {
                    $finalRoles[] = $roleName;
                }
            }

            $user->setRoles($finalRoles);
        }

        $userManager = $this->get('fos_user.user_manager');
        $userManager->updateUser($user);
    }

    protected function getAndValidateFormData($userId = null) {
        $data = array();
        $data['username'] = trim($this->POST->get('username'));
        $data['display_name'] = trim($this->POST->get('display_name'));
        $data['password'] = trim($this->POST->get('password'));
        $data['password2'] = trim($this->POST->get('password2'));
        $data['enabled'] = $this->POST->get('enabled');
        $data['roles'] = $this->POST->get('roles');
        $data['email'] = trim($this->POST->get('email', "{$data['username']}@tmp.abcwave.com"));

        $errors = array();

        $ok = true;
        $usernameLen = strlen($data['username']);
        if (!\preg_match('/[a-zA-Z0-9_-]/', $data['username']) || $usernameLen < 2 || $usernameLen > 25) {
            $errors['username'] = '用户名格式不正确';
            $this->addFlash('error', '用户名格式不正确');
            $ok = false;
        }

        $displayNameLen = mb_strlen($data['display_name']);
        if ($displayNameLen < 2 || $displayNameLen > 20) {
            $errors['display_name'] = '姓名格式不正确';
            $this->addFlash('error', '姓名格式不正确');
            $ok = false;
        }

        $userManager = $this->get('fos_user.user_manager');
        if ($userId) {
            $user = $userManager->findUserBy(array('id' => $userId));
        } else {
            $user = $userManager->createUser();
        }


        if ($data['password'] !== $data['password2']) {
            $errors['password'] = '两次输入的密码不匹配';
            $errors['password2'] = '两次输入的密码不匹配';
            $this->addFlash('error', '两次输入的密码不匹配');
            $ok = false;
        }

        if (!is_array($data['roles']) || count($data['roles']) < 1) {
            $errors['roles'] = '请至少选择一种用户组';
            $this->addFlash('error', '请至少选择一种用户组');
            $ok = false;
        }

        if ($errors) {
            $data['_errors'] = $errors;
        }

        return array($ok, $user, $data);
    }

}