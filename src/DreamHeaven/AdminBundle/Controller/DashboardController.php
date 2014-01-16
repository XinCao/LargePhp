<?php

namespace DreamHeaven\AdminBundle\Controller;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
use DreamHeaven\Component\Http\Exception\AccessDeniedHttpException;
use DreamHeaven\Component\Http\Exception\InvalidRequestHttpException;
use DreamHeaven\HuashuoBundle\Document\Embed\Coordinate;
use DreamHeaven\HuashuoBundle\Document\ApprovalStatus;
use DreamHeaven\HuashuoBundle\Document\Profile;
use DreamHeaven\HuashuoBundle\Document\Photo;
use DreamHeaven\HuashuoBundle\Helper\PaginationHelper;
use DreamHeaven\SearchBundle\Service\SearchService;
// </editor-fold>

class DashboardController extends BaseController
{
    public function indexAction()
    {
        $response = $this->renderResponse('DreamHeavenAdminBundle:Dashboard:index', array());
        return $response;
    }
}
