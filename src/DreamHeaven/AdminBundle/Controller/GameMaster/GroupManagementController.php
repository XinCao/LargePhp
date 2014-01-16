<?php

namespace DreamHeaven\AdminBundle\Controller\GameMaster;

use DreamHeaven\AdminBundle\Controller\BaseController;

class GroupManagementController extends BaseController {

    public function indexAction() {
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/GroupManagement:index');
        return $response;
    }

    public function newAction() {
        $groupname = trim($this->POST->get('group_name'));
        $doctrine = $this->getDoctrine();
        $conn = $doctrine->getConnection();
        $sql = "insert into groups(name, roles, preference)  values({$groupname} , 默认角色, 默认权限);";
        $conn->query($sql);
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/GroupManagement:index');
        return $response;
    }

    public function viewAction() {
        $limit = min($this->GET->getInt('count', 20), 100);
        $offset = max($this->GET->getInt('start', 0), 0);
        $doctrine = $this->getDoctrine();
        $conn = $doctrine->getConnection();
        $sql = "select id, name, roles, preference from groups ORDER BY enabled DESC, id ASC LIMIT {$limit} OFFSET {$offset};";
        $stmt = $conn->query($sql);
        $groupInfos = array();
        while ($stmt && $groupInfo = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $groupInfos[] = $groupInfo;
        }
        $viewData = array('groups' => $groupInfos);
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/GroupManagement:index', $viewData);
        return $response;
    }

    public function createAction() {
        
    }

    public function editAction() {
        
    }

    public function updateAction() {
        
    }

    public function deleteAction() {
        
    }

    protected function getRoles() {
        
    }

    protected function getAndValidateFormData() {
        
    }

    protected function saveGroup() {
        
    }

}