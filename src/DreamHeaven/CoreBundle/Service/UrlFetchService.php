<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DreamHeaven\CoreBundle\Service;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

use DreamHeaven\Component\Http\HttpClient;

require_once 'HTTP/Request2.php';
use HTTP_Request2;
use HTTP_Request2_Response;
/**
 * OAuthAuthenticationListener implements OAuth authentication.
 *
 * @author Liang Zhenjing <liangzhenjing@gmail.com>
 */
class UrlFetchService extends Service
{
    protected $options;
    private $logger;

    public function __construct(array $options = array(), LoggerInterface $logger = null)
    {
        $socketsEnabled = extension_loaded('sockets');
        $this->options = array_merge(array(
            'user-agent' => 'DreamHeavenHttpClient/0.2 (http://www.dreamheaven.com)',
            'request_config' => array('adapter' => $socketsEnabled ? 'socket' : 'curl'),
        ), $options);

        $this->logger = $logger;
    }

    /**
     * @param string $url
     * @param string $method
     * @param mixed $payload
     * @param array $headers
     * @return \HTTP_Request2_Response
     */
    public function fetch($url, $method = 'GET', $payload = '', $headers = array(), $options = array())
    {
        $payload = is_array($payload) ? http_build_query($payload) : $payload;

        if(empty($url) || !is_string($url))
        {
            throw new \InvalidArgumentException('Parameter $url can\'t be empty.');
        }

        $options = array_merge($this->options['request_config'], $options);
        $request = new \HTTP_Request2($url, $method, $options);
        $request->setHeader('user-agent', $this->options['user-agent']);
        foreach($headers as $key => $value)
        {
            $request->setHeader($key, $value);
        }

        $request->setBody($payload);

        $tryTimes = isset($options['retry']) ? (int)$options['retry'] : 1;
        $currentTry = max($tryTimes, 1);
        do
        {
            try
            {
                $response = $request->send();
                return $response;
            }
            catch(\Exception $ex)
            {
                $currentTry--;
                $message = sprintf('Failed to execute query, trys: %s/%s. error: %s', $currentTry, $tryTimes, $ex->getMessage());
                $this->logger->warn($message);
            }
        }
        while($currentTry > 0);

        return null;
    }

    /**
     * @param string $url
     * @param string|array $payload
     * @param array $headers
     * @return \HTTP_Request2_Response
     */
    public function get($url, $payload = '', $headers = array(), $options = array())
    {
        return $this->fetch($url, 'GET', $payload, $headers, $options);
    }

    /**
     * @param string $url
     * @param string|array $payload
     * @param array $headers
     * @return \HTTP_Request2_Response
     */
    public function post($url, $payload = '', $headers = array(), $options = array())
    {
        return $this->fetch($url, 'POST', $payload, $headers, $options);
    }

    /**
     * @param string $url
     * @param string|array $payload
     * @param array $headers
     * @return \HTTP_Request2_Response
     */
    public function put($url, $payload = '', $headers = array(), $options = array())
    {
        return $this->fetch($url, 'PUT', $payload, $headers, $options);
    }

    /**
     * @param string $url
     * @param string|array $payload
     * @param array $headers
     * @return \HTTP_Request2_Response
     */
    public function delete($url, $payload = '', $headers = array(), $options = array())
    {
        return $this->fetch($url, 'DELETE', $payload, $headers, $options);
    }
}
