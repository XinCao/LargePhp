<?php

namespace DreamHeaven\AdminBundle\Controller\GameManagement;

use DreamHeaven\CoreBundle\Controller\BaseController;

class OverviewController extends BaseController {

    public function indexAction() {
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameManagement/Overview:index', array());
        return $response;
    }

}