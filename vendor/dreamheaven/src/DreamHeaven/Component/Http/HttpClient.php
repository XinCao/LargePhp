<?php
namespace DreamHeaven\Component\Http;

/*
 * 这个类依赖于 PEAR 库里的 HTTP_Request2 包和 Net_URL2 包，需要自己安装
 * 安装方法：
 * sudo pear install Net_URL2-0.3.1
 * sudo pear install HTTP_Request2-0.5.2
 */
require_once 'HTTP/Request2.php';
class HttpClient extends \HTTP_Request2
{
    /**
     * @var HTTP_Request2_Response
     */
    protected $last_response = null;
    
    protected $base_url = null;
    
    public function __construct($url = null, $method = self::METHOD_GET, array $config = array())
    {
        parent::__construct($url, $method, $config);
        $this->setHeader('user-agent', 'DreamHeavenHttpClient/1.0 (http://www.dreamheaven.com)');
        //$this->setConfig('adapter', 'HTTP_Request2_Adapter_Curl');
    }

    public function get($url, $throw_exception_on_non_ok_response = false)
    {
        $url = $this->base_url ? $this->base_url . $url : $url;
        $this->setUrl($url);
        $this->setMethod(self::METHOD_GET);
        $this->last_response = $this->send();
        
        $this->_ensureStatusOK($throw_exception_on_non_ok_response);

        $body = $this->last_response->getBody();
        return $body;
    }

    public function post($url, array $post_data = array(), $throw_exception_on_non_ok_response = false)
    {
        $url = $this->base_url ? $this->base_url . $url : $url;
        $this->setUrl($url);
        $this->setMethod(self::METHOD_POST);
        $this->postParams = array();
        $this->addPostParameter($post_data);
        $this->last_response = $this->send();
        
        $this->_ensureStatusOK($throw_exception_on_non_ok_response);

        $body = $this->last_response->getBody();
        return $body;
    }

    public function put($url, $put_data = '', $throw_exception_on_non_ok_response = false)
    {
        $url = $this->base_url ? $this->base_url . $url : $url;
        $this->setUrl($url);
        $this->setMethod(self::METHOD_PUT);
        $body = self::_preparePutRequestBody($put_data);
        $this->setBody($body);
        $this->last_response = $this->send();
        
        $this->_ensureStatusOK($throw_exception_on_non_ok_response);

        $body = $this->last_response->getBody();
        return $body;
    }

    public function delete($url, $throw_exception_on_non_ok_response = false)
    {
        $url = $this->base_url ? $this->base_url . $url : $url;
        $this->setUrl($url);
        $this->setMethod(self::METHOD_DELETE);
        $this->last_response = $this->send();
        
        $this->_ensureStatusOK($throw_exception_on_non_ok_response);

        $body = $this->last_response->getBody();
        return $body;
    }
    
    public function getResponse()
    {
        return $this->last_response;
    }
    
    public function setBaseUrl($base_url)
    {
        $this->base_url = $base_url;
    }

    public function isStatusOK($status_code = null)
    {
        $status_code = $status_code ?: ($this->last_response ? $this->last_response->getStatus() : -1);
        return (200 <= $status_code && $status_code <= 299);
    }
    
    private function _ensureStatusOK($throw_exception_on_non_ok_response)
    {
        if($throw_exception_on_non_ok_response && !$this->isStatusOK())
        {
            $error = "status_code: \n". $this->last_response->getStatus() . "\nbody: \n" . $this->last_response->getBody();
            throw new Exception("Response status code is not 2xx.\n {$error}");
        }
    }
    
    public static function quickGet($url, $config = array())
    {
        $client = new HttpClient($url, self::METHOD_GET, $config);
        $response = $client->send();
        return $response ? $response->getBody() : false;
    }

    public static function quickPost($url, array $post_data = array(), $config = array())
    {
        $client = new HttpClient($url, self::METHOD_POST, $config);
        $client->addPostParameter($post_data);
        $response = $client->send();
        return $response ? $response->getBody() : false;
    }

    public static function quickPut($url, $put_data = '', $config = array())
    {
        $client = new HttpClient($url, self::METHOD_PUT, $config);
        $body = self::_preparePutRequestBody($put_data);
        $client->setBody($body);
        $response = $client->send();
        return $response ? $response->getBody() : false;
    }

    public static function quickDelete($url, $config = array())
    {
        $client = new HttpClient($url, self::METHOD_DELETE, $config);
        $response = $client->send();
        return $response ? $response->getBody() : false;
    }
    
    protected static function _preparePutRequestBody($put_data)
    {
        $body = '';
        if(is_array($put_data))
        {
            foreach($put_data as $key => $value)
            {
                $value = urlencode($value);
                $body .= "{$key}={$value}&";
            }
            
            trim($body, '&');
        }
        else
        {
            $body = $put_data;
        }

        return $body;
    }
}
