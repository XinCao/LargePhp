<?php

namespace DreamHeaven\AdminBundle\Controller\GameManagement;

use DreamHeaven\AdminBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServerInfoController extends BaseController {

    public function indexAction() {
        $includeManagementInfo = $this->GET->get('include-management-info', 'false') === 'true';
        $formatedServers = $this->getServerInfos($includeManagementInfo);
        $response = new JsonResponse($formatedServers);
        return $response;
    }

    private function getServerInfos($includeManagementInfo) {
        $platform = $this->GET->get('platform');
        if (!$platform) {
            return array();
        }

        $gmService = $this->get('gm_service');
        $gameServers = $gmService->getRealms($platform);

        $formatedServers = array();
        foreach ($gameServers as $serverInfo) {
            $serverInfo['concurrent_users'] = $gmService->getConcurrentUsers($serverInfo['host']);
            $serverInfo['load_info'] = $this->formatServerLoad($serverInfo['concurrent_users']);
            if ($serverInfo['concurrent_users'] == 'ERROR') {
                $serverInfo['maintenance'] = false;
            }
            if (!$includeManagementInfo) {
                unset($serverInfo['host'], $serverInfo['concurrent_users']);
            }

            $formatedServers[] = $serverInfo;
        }

        return $formatedServers;
    }

    private function formatServerLoad($concurrentUserNum) {
        $maxConcurrentUsers = 2000;
        $load = $concurrentUserNum / $maxConcurrentUsers;

        if ($concurrentUserNum == "ERROR") {
            $loadClass = 'important';
            $loadStr = "维护中";
        } elseif ($load >= 0.9) {
            $loadClass = 'important';
            $loadStr = "爆满";
        } elseif ($load > 0.6) {
            $loadClass = 'warning';
            $loadStr = "高";
        } elseif ($load > 0.3) {
            $loadClass = 'info';
            $loadStr = "中";
        } else {
            $loadClass = 'success';
            $loadStr = "低";
        }

        return array('load_class' => $loadClass, 'load_str' => $loadStr);
    }

}