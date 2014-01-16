<?php

namespace DreamHeaven\AdminBundle\Controller\PlayerManagement;

use Symfony\Component\HttpFoundation\JsonResponse;
use DreamHeaven\Component\Http\Exception\InvalidRequestHttpException;
use DreamHeaven\AdminBundle\Controller\BaseController;

class RoleInfoAjaxController extends BaseController {

    public function ajaxGetNamesByIdsAction() {
        $ids = trim($this->GET->get('ids'));
        $realm = trim($this->GET->get('realm'));

        $realms = $this->getRealms();

        if (!isset($realms[$realm]['host'])) {
            throw new InvalidRequestHttpException('Parameter realm is required.');
        }
        $serverHost = $realms[$realm]['host'];

        $ids = str_replace(",", ' ', $ids);
        $ids = array_filter(preg_split('/\s+/', $ids));

        if (!$ids) {
            throw new InvalidRequestHttpException('Parameter ids is required.');
        }

        $result = $this->getNamesByIds($serverHost, $ids);
        $response = new JsonResponse($result);
        return $response;
    }

    public function ajaxGetIdsByNamesAction() {
        $names = trim($this->GET->get('names'));
        $realm = trim($this->GET->get('realm'));

        $realms = $this->getRealms();
        if (!isset($realms[$realm]['host'])) {
            throw new InvalidRequestHttpException('Parameter server is required.');
        }
        $serverHost = $realms[$realm]['host'];

        $names = str_replace(",", ' ', $names);
        $names = array_filter(preg_split('/\s+/', $names));

        if (!$names) {
            throw new InvalidRequestHttpException('Parameter names is required.');
        }

        $result = $this->getIdsByNames($serverHost, $names);
        $response = new JsonResponse($result);
        return $response;
    }

    protected function getNamesByIds($server, $playerIds) {
        static $classNames = array(
    'WARRIOR:0' => '战士',
    'WARRIOR:1' => '狂战',
    'WARRIOR:2' => '圣战',
    'SCOUT:0' => '弓箭手',
    'SCOUT:1' => '猎人',
    'SCOUT:2' => '游侠',
    'MAGE:0' => '法师',
    'MAGE:1' => '冰法',
    'MAGE:2' => '火法',
        );

        $gmService = $this->get('gm_service');

        $result = array();
        $result['infos'] = array();
        $checkDuplicate = array();
        foreach ($playerIds as $playerId) {
            if (!trim($playerId)) {
                continue;
            }

            if (isset($checkDuplicate[$playerId])) {
                $playerInfo = $checkDuplicate[$playerId];
                $playerInfo['error'] = 'duplicated';
                $result['infos'][] = $playerInfo;
                continue;
            }

            $error = null;
            $playerInfo = null;
            if (is_numeric($playerId)) {
                $playerInfo = $gmService->getPlayerBriefInfoById($server, $playerId);
            }

            if (!$playerInfo) {
                $playerInfo = array('obj_id' => $playerId, 'player_name' => '', 'class' => '', 'profession' => '', 'level' => '', 'vip_level' => '', 'is_online' => '', 'error' => null);
                $playerInfo['error'] = 'not_found';
            } else {
                $key = "{$playerInfo['class']}:{$playerInfo['profession']}";
                $playerInfo['class_name'] = isset($classNames[$key]) ? $classNames[$key] : $key;
            }

            $result['infos'][] = $playerInfo;

            $checkDuplicate[$playerId] = $playerInfo;
        }

        $result['count'] = count($result['infos']);

        return $result;
    }

    protected function getIdsByNames($server, $playerNames) {
        $gmService = $this->get('gm_service');

        $result = array();
        $result['infos'] = array();
        $checkDuplicate = array();
        foreach ($playerNames as $playerName) {
            if (!trim($playerName)) {
                continue;
            }

            if (isset($checkDuplicate[$playerName])) {
                $playerInfo = $checkDuplicate[$playerName];
                $playerInfo['error'] = 'duplicated';
                $result['infos'][] = $playerInfo;
                continue;
            }

            $error = null;
            $playerId = $gmService->getPlayerIdByName($server, $playerName);

            if (!$playerId) {
                $error = 'not_found';
                $playerInfo = array('obj_id' => '', 'player_name' => $playerName, 'class' => '', 'class_name' => '', 'profession' => '', 'level' => '', 'vip_level' => '', 'is_online' => '', 'error' => $error);
            } else {
                $playerInfo = array('obj_id' => $playerId, 'player_name' => $playerName, 'class' => '', 'class_name' => '', 'profession' => '', 'level' => '', 'vip_level' => '', 'is_online' => '', 'error' => null);
            }


            $result['infos'][] = $playerInfo;

            $checkDuplicate[$playerName] = $playerInfo;
        }

        $result['count'] = count($result['infos']);
        return $result;
    }

}