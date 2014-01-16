<?php

namespace DreamHeaven\AdminBundle\Controller\PlayerManagement;

use DreamHeaven\AdminBundle\Controller\BaseController;
use DreamHeaven\AdminBundle\Helper\FormHelper;
use Lianz\SimpleFormBundle\Form;

class PlayerController extends BaseController {

    public function kickAction() {
        $realms = $this->getRealms();
        $data = $this->session->get('_admin_player_kick_form_data');
        $data = array_merge(array('realms' => $realms, 'realm' => '', 'note' => ''), (array) $data);
        $response = $this->renderResponse('DreamHeavenAdminBundle:PlayerManagement/Player:kick', $data);
        return $response;
    }

    public function doKickAction() {
        list($allOk, $server, $serverInfos, $kickAll, $playerInfos, $note, $data) = $this->getAndValidateKickParams();
        if (!$allOk) {
            $url = $this->generateUrl('admin_player_management_player_kick', array(), true);
            return $this->redirect($url);
        }
        $gmService = $this->get('gm_service');
        $logService = $this->get('op_logging_service');
        $result = array();
        if ($kickAll) {
            $succeed = $gmService->kickAllPlayers($server['host']);
            $message = $succeed ? "踢所有玩家下线成功" : "踢所有玩家下线失败";
            $this->addFlash($succeed, $message);
            $result[] = array('realm' => $server['realm'], 'host' => $server['host'], 'name' => $server['name'], 'succeed' => $succeed, 'message' => $message);
            $logService->addLog($succeed, 'player.kick_all', 'player-management', $note, $data, $result, $serverInfos, $message);
        } else {
            $sent = array();
            $allMsg = '';
            $allSucceed = true;
            foreach ($playerInfos as $playerId => $playerName) {
                if (isset($sent[$playerId])) {
                    $this->addFlash("warning", "重复的玩家《{$playerName} (ID={$playerId})》，已经跳过此玩家");
                    continue;
                }
                $sent[$playerId] = $playerId;
                $succeed = $gmService->kickPlayerById($server['host'], $playerId, $note);
                $allSucceed = $succeed ? $allSucceed : false;
                $message = $succeed ? "踢玩家《{$playerName}(ID={$playerId})}》下线成功" : "踢玩家《{$playerName}(ID={$playerId})}》下线失败";
                $this->addFlash($succeed, $message);
                $allMsg .= "{$message}\n";
                $result[] = array('realm' => $server['realm'], 'host' => $server['host'], 'name' => $server['name'], 'succeed' => $succeed, 'message' => $message);
            }
            $logService->addLog($succeed, 'player.kick_all', 'player-management', $note, $data, $result, $serverInfos, $allMsg);
        }
        $url = $this->generateUrl('admin_player_management_player_kick', array(), true);
        return $this->redirect($url);
    }

    private function getAndValidateKickParams() {
        $realmId = trim($this->POST->get('realm'));
        $kickAll = trim($this->POST->get('kick_all'));
        $playerIdsStr = trim($this->POST->get('player_ids'));
        $playerNamesStr = trim($this->POST->get('player_names'));
        $note = trim($this->POST->get('note'));
        $allOk = true;
        FormHelper::init($this->flashBag);
        $serverList = $this->getRealms();
        $serverInfos = FormHelper::checkServer($realmId, $serverList);
        $allOk = $serverInfos ? $allOk : false;
        $playerInfos = array();
        if (!$kickAll) {
            $playerInfos = FormHelper::checkPlayerInfos($playerIdsStr, $playerNamesStr);
            $allOk = $playerInfos ? $allOk : false;
        }
        $note = FormHelper::checkNote($note);
        $allOk = $note ? $allOk : false;
        $data = array(
            'servers' => $realmId,
            'kick_all' => $kickAll,
            'player_ids' => $playerIdsStr,
            'player_names' => $playerNamesStr,
            'note' => $note,
        );
        $this->session->set('_admin_player_kick_form_data', $data);
        $server = isset($serverInfos[$realmId]) ? $serverInfos[$realmId] : null;
        return array($allOk, $server, $serverInfos, $kickAll, $playerInfos, $note, $data);
    }

    public function sendMailAction() {
        $form = new Form($this->container, true);
        $form->init(array(
            'realm' => array('required, single_realm', 'single_realm'),
            'player_ids' => array('required, player_ids', 'split_ids'),
            'player_names' => array('required', 'split_names'),
            'sender' => array('required'),
            'content' => array('required'),
            'note' => array('required, min_length[5]'),
            'item_id1' => array('is_natural_no_zero'),
            'item_num1' => array('is_natural_no_zero, item_num[1]'),
            'item_id2' => array('is_natural_no_zero'),
            'item_num2' => array('is_natural_no_zero, item_num[2]'),
            'item_id3' => array('is_natural_no_zero'),
            'item_num3' => array('is_natural_no_zero, item_num[3]'),
            'item_id4' => array('is_natural_no_zero'),
            'item_num4' => array('is_natural_no_zero, item_num[4]'),
        ));

        $gmService = $this->get('gm_service');

        if ($this->request->isMethod('POST') && $form->bind($this->POST)->validate()) {
            $realm = $form->get('realm');
            $playerIds = $form->get('player_ids');
            $playerNames = $form->get('player_names');

            $result = array();
            $allSucceed = true;
            foreach ($playerIds as $idx => $playerId) {
                $playerId = (int) $playerId;
                $mail1 = array('player_id' => $playerId, 'sender' => $form->get('sender'), 'content' => $form->get('content'),
                    'item_id1' => $form->getInt('item_id1'), 'item_num1' => $form->getInt('item_num1'),
                    'item_id2' => $form->getInt('item_id2'), 'item_num2' => $form->getInt('item_num2'));
                $succeed = $gmService->sendMail($realm['host'], $mail1);

                if ($succeed && ($form->get('item_id3', null) || $form->get('item_id4', null))) {
                    $mail2 = array('player_id' => $playerId, 'sender' => $form->get('sender'), 'content' => $form->get('content'),
                        'item_id1' => $form->getInt('item_id3'), 'item_num1' => $form->getInt('item_num3'),
                        'item_id2' => $form->getInt('item_id4'), 'item_num2' => $form->getInt('item_num4'));
                    $succeed = $gmService->sendMail($realm['host'], $mail2);
                }

                $allSucceed = $succeed ? $allSucceed : false;

                $playerName = $playerNames[$idx];
                $message = $succeed ? "给玩家《{$playerName}(ID={$playerId})》发送邮件成功" : "给玩家《{$playerName}(ID={$playerId})》发送邮件失败";
                $this->addFlash($succeed, $message);

                $result[] = array('realm' => $realm['realm'], 'host' => $realm['host'], 'name' => $realm['name'], 'full_name' => $realm['full_name'], 'succeed' => $succeed, 'message' => $message);
            }

            $logService = $this->get('op_logging_service');
            $serverInfos = array($realm['realm'] => $realm);
            $logService->addLog($allSucceed, 'player.send_mail', 'player-management', $form->get('note'), $form->getFieldValues(), $result, $serverInfos, $message);
            //这个重定向是为了防止玩家在发邮件时，再次刷新，造成再次发送邮件。
            $url = $this->generateUrl('admin_player_management_player_send_mail', array(), true);
            return $this->redirect($url);
        }

        $data = array('form' => $form, 'realms' => $this->getRealms(), 'realm' => $form->get('realm'));
        $response = $this->renderResponse('DreamHeavenAdminBundle:PlayerManagement/Player:sendMail', $data);
        return $response;
    }

    public function inspectAction() {
        list($allOk, $playerId, $realm, $serverList) = $this->getAndValidateInspectParams();

        $data = array('realms' => $serverList, 'player_id' => $playerId, 'realm' => $realm ? $realm['id'] : '');

        if ($allOk) {
            $gmService = $this->get('gm_service');
            $playerInfo = $gmService->getPlayerInfoById($realm['host'], $playerId, 63);

            if (!$playerInfo) {
                $this->addFlash('error', '获取用户信息失败，请重试');
            } else {
                $info = array('id' => $playerId, 'name' => $playerInfo['common_data']['player_name']);
                $playerInfo['role_info'] = $info;
                $orderItemName = $this->getItemName();
                $i = 0;
                foreach ($playerInfo['inventory_info'] as $row) {
                    $playerInfo['inventory_info'][$i]['item_name'] = $orderItemName[$row['obj_id']];
                    $i++;
                }

                $data['player_info'] = $playerInfo;
            }
        }

        $response = $this->renderResponse('DreamHeavenAdminBundle:PlayerManagement/Player:inspect', $data);
        return $response;
    }

    private function getItemName() {
        $sql = <<<EOF
            SELECT
                item_id, item_name
            FROM
                item_list
EOF;
        $conn = $this->getPlatformConnection('game_logs_db');
        $report = $conn->fetchAll($sql);
        $orderItemName = array();
        foreach ($report as $row) {
            $orderItemName[$row['item_id']] = $row['item_name'];
        }
        return $orderItemName;
    }

    private function getAndValidateInspectParams() {
        $playerId = $this->GET->get('player_id');
        $realmId = trim($this->GET->get('realm'));

        $serverList = $this->getRealms();

        // 如果是null，说明是刚点击进来的，还没提交，所以不需要做参数检查
        if ($playerId === null) {
            return array(false, 0, null, $serverList);
        }

        $allOk = true;
        FormHelper::init($this->flashBag);

        if (!$playerId) {
            $this->addFlash('error', '玩家 ID 参数错误');
            $allOk = false;
        }

        $serverInfos = FormHelper::checkServer($realmId, $serverList);
        $allOk = $serverInfos ? $allOk : false;

        $realm = isset($serverInfos[$realmId]) ? $serverInfos[$realmId] : null;
        return array($allOk, (int) $playerId, $realm, $serverList);
    }

    public function dataManipulationAction() {
        $serverList = $this->getRealms();

        $data = (array) $this->session->get('_admin_player_data_manipulation_form_data');
        $data = array_merge(array('realms' => $serverList, 'realm' => '', 'player_ids' => '', 'player_names' => '', 'field_name' => '', 'new_value' => '', 'note' => ''), $data);

        $response = $this->renderResponse('DreamHeavenAdminBundle:PlayerManagement/Player:dataManipulation', $data);
        return $response;
    }

    public function doDataManipulationAction() {
        list($allOk, $server, $serverInfos, $playerInfos, $fieldName, $newValue, $note, $serverList, $data) = $this->getAndValidateDataManipulationParams();

        if ($allOk) {
            $allSucceed = true;
            $result = array();
            $gmService = $this->get('gm_service');
            $allMsg = '';

            foreach ($playerInfos as $playerId => $playerName) {
                switch ($fieldName) {
                    case 'level':
                        $succeed = $gmService->setPlayerLevel($server['host'], $playerId, $newValue);
                        $fieldStr = '[等级]';
                        break;
                    case 'vip_level':
                        $succeed = $gmService->setPlayerVipLevel($server['host'], $playerId, $newValue);
                        $fieldStr = '[VIP 等级]';
                        break;
                }

                $allSucceed = $succeed ? $allSucceed : false;

                $succeedStr = $succeed ? '成功' : '失败';

                $message = "修改玩家《{$playerName}(ID={$playerId})》 {$fieldStr} {$succeedStr}";
                $allMsg .= "{$message}\n";
                $this->addFlash($succeed, $message);

                $result[] = array('realm' => $server['realm'], 'host' => $server['host'], 'name' => $server['name'], 'succeed' => $succeed, 'message' => $message);
            }

            $logService = $this->get('op_logging_service');
            $logService->addLog($allSucceed, 'data_manipulate', 'player-management', $note, $data, $result, $serverInfos, $allMsg);
        }

        $url = $this->generateUrl('admin_player_management_player_data_manipulation', array(), true);
        return $this->redirect($url);
    }

    private function getAndValidateDataManipulationParams() {
        $realmId = trim($this->POST->get('realm'));
        $playerIdsStr = trim($this->POST->get('player_ids'));
        $playerNamesStr = trim($this->POST->get('player_names'));
        $fieldName = trim($this->POST->get('field_name'));
        $newValue = trim($this->POST->get('new_value'));
        $note = trim($this->POST->get('note'));

        $allOk = true;
        FormHelper::init($this->flashBag);

        $serverList = $this->getRealms();
        $serverInfos = FormHelper::checkServer($realmId, $serverList);
        $allOk = $serverInfos ? $allOk : false;

        $playerInfos = FormHelper::checkPlayerInfos($playerIdsStr, $playerNamesStr);
        $allOk = $playerInfos ? $allOk : false;

        $validFieldDefs = array(
            // 'field_name' => 'regex pattern',
            'level' => '/\d+/',
            'vip_level' => '/\d+/',
        );

        if (!isset($validFieldDefs[$fieldName])) {
            $user = $this->getUser();
            $error = sprintf('User %s(ID=%s, username=%s) attempted to manipulate unsupported field: field_name=%s, value=%s', $user->display_name, $user->id, $user->username, $fieldName, $newValue);
            $this->get('monolog.logger.security')->error($error);

            $this->addFlash('error', '不支持修改次数据项，本次操作已经记入系统日记备查');
            $allOk = false;
        }
        if (!preg_match($validFieldDefs[$fieldName], $newValue)) {
            $user = $this->getUser();
            $error = sprintf('User %s(ID=%s, username=%s) attempted to manipulate field with invalid value: field_name=%s, value=%s', $user->display_name, $user->id, $user->username, $fieldName, $newValue);
            $this->get('monolog.logger.security')->error($error);

            $this->addFlash('error', '请不要提交非法数据，本次操作已经记入系统日记备查');
            $allOk = false;
        }

        $note = FormHelper::checkNote($note);
        $allOk = $note ? $allOk : false;

        $server = isset($serverInfos[$realmId]) ? $serverInfos[$realmId] : null;

        $data = array('server' => $realmId, 'player_ids' => $playerIdsStr, 'player_names' => $playerNamesStr, 'field_name' => $fieldName, 'new_value' => $newValue, 'note' => $note);
        $this->session->set('_admin_player_data_manipulation_form_data', $data);

        return array($allOk, $server, $serverInfos, $playerInfos, $fieldName, $newValue, $note, $serverList, $data);
    }

}