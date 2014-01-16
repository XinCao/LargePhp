<?php
namespace DreamHeaven\AdminBundle\ContentApproval\Formatter;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
use Symfony\Component\DependencyInjection\ContainerInterface;
use DreamHeaven\AdminBundle\Document\PendingApprovalObject as PAO;
// </editor-fold>

abstract class BaseFormatter implements IPendingApprovalObjectFormatter
{
    protected $container;
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
