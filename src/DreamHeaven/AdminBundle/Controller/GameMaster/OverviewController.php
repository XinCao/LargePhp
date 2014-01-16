<?php

use DreamHeaven\CoreBundle\Controller\BaseController;

namespace DreamHeaven\AdminBundle\Controller\GameMaster;

class OverviewController extends BaseController {

    public function indexAction() {
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/Overview:index', array());
        return $response;
    }

}