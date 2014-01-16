<?php
namespace DreamHeaven\AdminBundle\ContentApproval\Formatter;

use Symfony\Component\DependencyInjection\ContainerInterface;
use DreamHeaven\AdminBundle\Document\PendingApprovalObject as PAO;

interface IPendingApprovalObjectFormatter
{
    public function setContainer(ContainerInterface $container = null);
    public function fetch($objectId);
    public function format($object);
}
