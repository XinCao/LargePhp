<?php

namespace DreamHeaven\AdminBundle\Controller;

use Doctrine\DBAL\Connection;
use DreamHeaven\Component\Http\Exception\InvalidRequestHttpException;
use DreamHeaven\CoreBundle\Controller\BaseController as CoreBaseController;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseController extends CoreBaseController {

    protected $session;
    protected $flashBag;

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);

        $this->session = $container->get('session');
        $this->flashBag = $this->session->getFlashBag();
    }

    protected function addFlash($type, $msg) {
        $type = is_bool($type) ? ($type ? 'success' : 'error') : $type;
        $this->flashBag->add($type, $msg);
    }

    /**
     * 
     * @abstract 获得当前平台
     */
    protected function getCurrentPlatform() {
        $curPlatform = $this->GET->get('platform', $this->getParameter('default_platform'));
        $platforms = $this->getParameter('platforms');
        if (!isset($platforms[$curPlatform])) {
            throw new InvalidRequestHttpException("未知平台：{$curPlatform}");
        }

        return $curPlatform;
    }

    /**
     * 
     * @abstract 获得默认平台的数据库连接
     */
    protected function getDbalConnection() {
        return $this->get('doctrine.dbal.default_connection');
    }

    /**
     * 
     * @abstract 获得指定平台的数据库连接
     */
    protected function getPlatformConnection($name) {
        $curPlatform = $this->getCurrentPlatform();
        $platforms = $this->getParameter('platforms');

        $platformInfo = $platforms[$curPlatform];
        $connUri = "http://{$platformInfo[$name]}";
        $connInfo = \parse_url($connUri);
        $charset = 'utf8';
        if (isset($connInfo['query'])) {
            \parse_str($connInfo['query'], $query);
            $charset = isset($query['charset']) ? \trim($query['charset']) : $charset;
        }

        $params = array(
            'dbname' => \trim($connInfo['path'], '/ '),
            'host' => $connInfo['host'],
            'port' => $connInfo['port'],
            'user' => $connInfo['user'],
            'password' => $connInfo['pass'],
            'charset' => $charset,
            'driver' => 'pdo_mysql', 'driverOptions' => array());

        $connection = $this->get('doctrine.dbal.connection_factory')->createConnection($params);
        return $connection;
    }

    /**
     * 
     * @abstract 获得当前平台的所有区服信息
     */
    public function getRealms() {
        $platform = $this->getCurrentPlatform();
        return $this->get('gm_service')->getRealms($platform);
    }

}
