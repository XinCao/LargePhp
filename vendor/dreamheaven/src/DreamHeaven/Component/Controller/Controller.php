<?php

namespace DreamHeaven\Component\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController {

    /** @var ParameterBag */
    protected $GET;

    /** @var ParameterBag */
    protected $POST;

    /** @var ParameterBag */
    protected $SERVER;

    /** @var ParameterBag */
    protected $FILES;

    /** @var ParameterBag */
    protected $COOKIES;

    /** @var ParameterBag */
    protected $HEADERS;

    /** @var Request */
    protected $request;
    protected $format;
    protected $logger;
    protected $security;

    protected function getParameter($parameterName) {
        return $this->container->getParameter($parameterName);
    }

    protected function getCurrentUserAccount() {
        $token = $this->security->getToken();
        return $currentUser = $token ? $token->getUser() : null;
    }

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);

        $request = $container->get('request');
        $this->GET = $request->query;
        $this->POST = $request->request;
        $this->SERVER = $request->server;
        $this->FILES = $request->files;
        $this->COOKIES = $request->cookies;
        $this->HEADERS = $request->headers;
        $this->request = $request;
        $this->format = $request->getRequestFormat();

        $this->logger = $container->get('logger'); // Symfony\Bridge\Monolog\Logger
        $this->security = $container->get('security.context'); // Symfony\Component\Security\Core\SecurityContext
    }

    /**
     *
     * @param type $view
     * @param type $viewData
     * @param Response $originResponse
     * @param type $templateEngine
     * @return Response
     */
    protected function renderResponse($view, $viewData = array(), Response $originResponse = null, $templateEngine = 'twig') {
        $view = "{$view}.{$this->format}.{$templateEngine}";
        $response = $this->get('templating')->renderResponse($view, $viewData, $originResponse);
        $response->headers->set('X-Powered-By', 'XWS/1.0', true);

        return $response;
    }

    protected function isMobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }

        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset($_SERVER['HTTP_VIA'])) {
            //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }

        //脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung',
                'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel',
                'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront',
                'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi',
                'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }

        //协议法，因为有可能不准确，放到最后判断
        if (isset($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            $http_accept = $_SERVER['HTTP_ACCEPT'];
            if ((strpos($http_accept, 'vnd.wap.wml') !== false) && (strpos($http_accept, 'text/html') === false || (strpos($http_accept, 'vnd.wap.wml') < strpos($http_accept, 'text/html')))) {
                return true;
            }

            if (preg_match('/ss\/[0-9]+x[0-9]+,uc\/[0-8]+$/i', $http_accept)) {
                return true;
            }
        }


        return false;
    }

}