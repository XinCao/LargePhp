<?php

namespace DreamHeaven\AdminBundle\ContentApproval\ApprovalStrategy;

use Symfony\Component\DependencyInjection\ContainerInterface;
use DreamHeaven\AdminBundle\Document\ApprovalResult;

interface IApprovalStrategy {

    public function setContainer(ContainerInterface $container = null);

    public function supports($type);

    public function add(ApprovalResult $result);

    public function execute();
}
