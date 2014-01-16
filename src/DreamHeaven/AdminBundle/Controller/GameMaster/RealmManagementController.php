<?php

use DreamHeaven\CoreBundle\Controller\BaseController;

namespace DreamHeaven\AdminBundle\Controller\GameMaster;

class RealmManagementController extends BaseController {

    public function editAction() {
        $platform = $this->getCurrentPlatform();
        $conn = $this->get('doctrine.dbal.default_connection');
        $platform = str_replace('_', '-', $platform);
        $sql = "SELECT * FROM realms WHERE platform='{$platform}'";

        $realms = $conn->fetchAll($sql);
        $now = date('Y-m-d H:i:s');
        if ($this->request->isMethod('POST')) {
            $action = $this->POST->get('action');
            if ($action === 'save') {
                $this->doSave();
            } else if ($action === 'delete') {
                $this->doDelete();
            } else {
                $this->addFlash('error', '非法操作');
            }

            return $this->redirect($this->generateUrl($this->request->get('_route')));
        }

        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/RealmManagement:edit', array('realms' => $realms));
        return $response;
    }

    private function doSave() {
        $ids = $this->POST->get('ids', array());

        $fields = array('num' => '序号', 'name' => '名字', 'address' => '地址', 'mgmt_address' => '管理地址',);
        $dup = array();
        foreach ($ids as $id) {
            foreach ($fields as $key => $text) {
                $fieldValue = $this->POST->get("{$id}:{$key}");
                /*
                 * 这样造成的结构，对输入的数据不进行验证。
                 */
//                if(isset($dup["{$key}:{$fieldValue}"])) {
//                    $this->addFlash('error', "服务器{$text}不能重复: id={$id}, {$text}={$fieldValue}");
//                    return;
//                }

                $dup["{$key}:{$fieldValue}"] = true;
            }
        }

        $now = \date('Y-m-d H:i:s');
        $conn = $this->get('doctrine.dbal.default_connection');
        foreach ($ids as $id) {
            $id = \trim($id);
            if (!$id) {
                continue;
            }

            $data = array(
                'realm_num' => $this->POST->get("{$id}:num"),
                'name' => $this->POST->get("{$id}:name"),
                'type' => $this->POST->getInt("{$id}:type", 0),
                'address' => $this->POST->get("{$id}:address"),
                'mgmt_address' => $this->POST->get("{$id}:mgmt_address"),
                'updated_at' => $now,
            );

            $conn->update('realms', $data, array('id' => $id));
        }

        // 保存新增的服务器
        $newNums = $this->POST->get('new:num');
        $newNames = $this->POST->get('new:name');
        $newTypes = $this->POST->get('new:type');
        $newAddrs = $this->POST->get('new:address');
        $newMgmtAddrs = $this->POST->get('new:mgmt_address');

        $now = \date('Y-m-d H:i:s');
        $platform = $this->getCurrentPlatform();

        if ($newNums) {
            foreach ($newNums as $index => $value) {
                $data = array(
                    'id' => "{$platform}-{$newNums[$index]}",
                    'platform' => $platform,
                    'realm_num' => $newNums[$index],
                    'name' => $newNames[$index],
                    'type' => $newTypes[$index],
                    'address' => $newAddrs[$index],
                    'mgmt_address' => $newMgmtAddrs[$index],
                    'updated_at' => $now,
                );

                $conn->insert('realms', $data);
            }
        }

        $this->addFlash('success', "保存服务器列表成功");
    }

    private function doDelete() {
        $conn = $this->get('doctrine.dbal.default_connection');
        $selectedIds = $this->POST->get('selected_ids');
        if ($selectedIds) {
            foreach ($selectedIds as $id) {
                $conn->delete('realms', array('id' => $id));
                $this->addFlash(true, "删除服务器 {$id} 成功");
            }
        } else {
            $this->addFlash(false, "请选择至少一个服务器再删除");
        }
    }

}