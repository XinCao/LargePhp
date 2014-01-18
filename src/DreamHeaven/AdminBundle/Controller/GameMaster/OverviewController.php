<?php
namespace DreamHeaven\AdminBundle\Controller\GameMaster;

use DreamHeaven\AdminBundle\Controller\BaseController;

class OverviewController extends BaseController {

    public function indexAction() {
        $response = $this->renderResponse('DreamHeavenAdminBundle:GameMaster/Overview:index', array());
        return $response;
    }

}