<?php

namespace DreamHeaven\CoreBundle\Service;

use DreamHeaven\CoreBundle\Service\Service as BaseService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class MessageQueueService extends BaseService
{

    /** @var ContainerInterface */
    protected $container;

    /** @var \Stomp */
    protected $broker = null;

    /** @var \LoggerInterface */
    protected $logger;
    protected $brokerUri;
    protected $username;
    protected $password;
    protected $timeout = 2;
    protected $serviceName = 'default';

    public function __construct(ContainerInterface $container, LoggerInterface $logger = null, $serviceName = 'default')
    {
        $this->container   = $container;
        $this->logger      = $logger;
        $this->serviceName = $serviceName;

        $this->brokerUri = $container->getParameter("mq.servers.{$serviceName}.host");
        $this->username  = $container->getParameter("mq.servers.{$serviceName}.username");
        $this->password  = $container->getParameter("mq.servers.{$serviceName}.password");

        if($container->hasParameter("mq.servers.{$serviceName}.timeout"))
        {
            $this->timeout = $container->getParameter("mq.servers.{$serviceName}.timeout");
        }
    }

    private function connectBroker()
    {
        if ($this->broker)
        {
            return;
        }

        try
        {
            $this->broker = new \Stomp($this->brokerUri, $this->username, $this->password);

            $sec = (int)$this->timeout;
            $microSec = ($this->timeout - $sec) * 1000000;
            $this->broker->setReadTimeout($sec, $microSec);
        }
        catch (\StompException $ex)
        {
            $this->logger->err('Connection failed: ' . $ex->getMessage());
            throw $ex;
        }
    }

    public function abort($transactionId, array $headers = array())
    {
        $this->connectBroker();
        return $this->broker->abort($transactionId, $headers);
    }

    public function ack($msg, array $headers = array())
    {
        $this->connectBroker();
        return $this->broker->ack($msg, $headers);
    }

    public function begin($transactionId, array $headers = array())
    {
        $this->connectBroker();
        return $this->broker->begin($transactionId, $headers);
    }

    public function commit($transactionId, array $headers = array())
    {
        $this->connectBroker();
        return $this->broker->commit($transactionId, $headers);
    }

    public function error()
    {
        $this->connectBroker();
        return $this->broker->error();
    }

    public function getSessionId()
    {
        $this->connectBroker();
        return $this->broker->getSessionId();
    }

    public function hasFrame()
    {
        $this->connectBroker();
        return $this->broker->hasFrame();
    }

    public function readFrame()
    {
        $this->connectBroker();
        return $this->broker->readFrame();
    }

    public function send($destination, $payload, array $headers = array())
    {
        $this->connectBroker();
        return $this->broker->send($destination, $payload, $headers);
    }

    public function subscribe($destination, array $headers = array())
    {
        $this->connectBroker();
        return $this->broker->subscribe($destination, $headers);
    }

    public function unsubscribe($destination, array $headers = array())
    {
        $this->connectBroker();
        return $this->broker->unsubscribe($destination, $headers);
    }

    public function setReadTimeout($sec, $microSec = 0)
    {
        $this->connectBroker();
        $this->timeout = $sec + $microSec * 1000000;
        return $this->broker->setReadTimeout($sec, $microSec = 0);
    }

    public function getReadTimeout()
    {
        $this->connectBroker();
        return $this->broker->getReadTimeout();
    }
}
