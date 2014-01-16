<?php

namespace DreamHeaven\AdminBundle\Controller\GameMaster;

use DreamHeaven\AdminBundle\Controller\BaseController;

class OperationLogViewController extends BaseController {
    public function logsAction() {
        $limit  = min($this->GET->getInt('limit', 15), 100);
        $offset = max($this->GET->getInt('offset', 0), 0);
        $logService = $this->get('op_logging_service');
        $opList = null;
        $data = $logService->getLogs($opList, $offset, $limit);
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/OperationLogView:logs', $data);
        return $response;
    }
}
