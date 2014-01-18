<?php

namespace DreamHeaven\AdminBundle\Event\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class FilterControllerListener {

    protected $container;
    protected $logger;
    protected $options;

    public function __construct(ContainerInterface $container, LoggerInterface $logger, $options = array()) {
        $this->container = $container;
        $this->logger = $logger;
        $this->options = $options;
    }

    /**
     * TODO 再加上并且当前后台账户没有找到模拟账号
     * 试图给当前后台账户模拟一个账户，如果没有则抛错
     * @param \DreamHeaven\AdminBundle\Event\Listener\FilterControllerEvent $e
     * @throws AccessDeniedHttpException
     */
    public function onCoreController(FilterControllerEvent $e) {
        $controller = $e->getController();
        if (!$this->checkCurrentSimulationProfile($controller)) {
            throw new AccessDeniedHttpException('Simulation user not found.');
        }
    }

    protected function checkCurrentSimulationProfile($controller) {
        $class = get_class($controller[0]);
        $classArr = explode('\\', $class);
        if (count($classArr) > 2 && $classArr[1] == 'AdminBundle' && $classArr[3] == 'CustomerService') {
            $session = $this->container->get('session');
            $currentUser = $session->get('current_simulation_profile');
            if (!$currentUser) {
                return false;
            }
        }
        return true;
    }

}