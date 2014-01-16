<?php

namespace DreamHeaven\AdminBundle\ContentApproval\ApprovalStrategy;

use Symfony\Component\DependencyInjection\ContainerInterface;
use DreamHeaven\AdminBundle\Document\ApprovalResult;
use DreamHeaven\AdminBundle\Document\PendingApprovalObject as PAO;
use Symfony\Component\HttpFoundation\ParameterBag;
use DreamHeaven\HuashuoBundle\Document as D;

abstract class BaseApprovalStrategy implements IApprovalStrategy {

    protected $container;
    protected $logger;
    protected $adminDm;
    protected $workQueue;
    public $parameters;

    public function __construct() {
        $this->parameters = new ParameterBag();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
        $this->adminDm = $this->container->get('doctrine.odm.mongodb.admin_document_manager');

        $fqn = get_called_class();
        $parts = explode('\\', $fqn);
        $channel = end($parts);
        $this->logger = new \Symfony\Bridge\Monolog\Logger($channel);
        $this->logger->pushHandler($this->container->get('monolog.handler.main'));
    }

    public function add(ApprovalResult $result) {
        $this->workQueue[] = $result;
    }

    protected function init() {
        
    }

    protected function commit() {
        
    }

    abstract protected function process(ApprovalResult $result);

    public function execute() {
        $this->logger->debug('init begin');
        $this->init();
        $this->logger->debug('init end');

        $this->logger->debug('processing begin');
        foreach ($this->workQueue as $result) {
            $msg = sprintf('loading PendingApprovalObject, pid=%s', $result->pid);
            $this->logger->debug($msg);

            $pao = $this->getOrCreatePendingApprovalObject($result);
            if (!$pao) {
                $msg = sprintf('PendingApprovalObject not found, pid=%s, object_id=%s, object_type=%s', $result->pid, $result->object_id, $result->object_type);
                $this->logger->warn($msg);
                continue;
            }

            $result->object_id = $pao->object_id;
            $result->object_type = $pao->object_type;

            $this->processSingleResult($result);

            $pao->processed = true;
            $pao->processed_at = $now = time();
            $pao->updated_at = $now;

            $this->adminDm->persist($result);
            $this->adminDm->persist($pao);
        }

        $this->adminDm->flush();
        $this->logger->debug('processing end');

        $this->logger->debug('commit begin');

        $this->commit();

        $this->logger->debug('commit end');
    }

    protected function processSingleResult(ApprovalResult $result) {
        $msg = sprintf('begin to process single result: object_id=%s, object_type=%s, action=%s, approval_status=%s', $result->object_id, $result->object_type, $result->action, $result->result_status);
        $this->logger->debug($msg);

        $this->process($result);

        $this->logger->debug('end process single result');
    }

    protected function sendApprovalNotification($authorId, $reason, $targetId) {
        try {
            $nm = $this->container->get('notification_manager');
            $notification = D\Notification::createSystemNotification($authorId, $reason, $targetId);
            $nm->sendSystemNotification($notification, array($authorId));

            $this->logger->debug(sprintf('notification sent to user %s', $authorId));
        } catch (\Exception $e) {
            $this->logger->err(sprintf('failed to send notification, user_id=%s, message=%s, error=%s', $authorId, $reason, $e->getMessage()));
        }
    }

    private function getOrCreatePendingApprovalObject(ApprovalResult $result) {
        if ($result->pid) {
            $pao = $this->adminDm->find(PAO::CLASS_NAME, $result->pid);
        } elseif ($result->object_id && $result->object_type) {
            $pao = new PAO();
            $pao->object_id = $result->object_id;
            $pao->object_type = $result->object_type;

//            $pao->reason      = $result->reason_text;
            $pao->reporter_id = $result->operator_id;
            $pao->created_at = $now = time();
            $pao->updated_at = $now;
        } else {
            $pao = null;
        }

        return $pao;
    }

}
