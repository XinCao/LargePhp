<?php
namespace DreamHeaven\Component\OAuth1;

use DreamHeaven\Component\OAuth1\SignatureMethod\OAuthSignatureMethodHmacSha1;
use DreamHeaven\Component\OAuth1\OAuthConsumer;
use DreamHeaven\Component\OAuth1\OAuthUtil;

class OAuth
{
    /**
	 * Contains the last HTTP status code returned. 
	 *
	 * @ignore
	 */
	public $httpCode;

	/**
	 * Contains the last API call.
	 *
	 * @ignore
	 */
	public $url;

	/**
	 * Set up the API root URL.
	 *
	 * @ignore
	 */
	//public $host = "http://api.t.sina.com.cn/";
	public $host;

	/**
	 * Set timeout default.
	 *
	 * @ignore
	 */
	public $timeout = 30;

	/**
	 * Set connect timeout.
	 *
	 * @ignore
	 */
	public $connectTimeout = 30;

	/**
	 * Verify SSL Cert.
	 *
	 * @ignore
	 */
	public $sslVerifypeer = false;

	/**
	 * Respons format.
	 *
	 * @ignore
	 */
	public $format = 'json';

	/**
	 * Decode returned json data.
	 *
	 * @ignore
	 */
	public $decodeJson = true;

	/**
	 * Contains the last HTTP headers returned.
	 *
	 * @ignore
	 */
	public $httpInfo;

	/**
	 * Set the useragnet.
	 *
	 * @ignore
	 */
	public $userAgent = 'DreamHeaven OAuth 1.0a';

	/* Immediately retry the API call if the response was not successful. */
	//public $retry = true;

	/**
	 * construct WeiboOAuth object
	 */
	function __construct($host, $consumerKey, $consumerSecret, $oauthToken = null, $oauthTokenSecret = null)
    {
		$this->signatureMethod = new OAuthSignatureMethodHmacSha1();
		$this->consumer = new OAuthConsumer($consumerKey, $consumerSecret);
        $this->host = $host;

		if (!empty($oauthToken) && !empty($oauthTokenSecret))
        {
			$this->token = new OAuthConsumer($oauthToken, $oauthTokenSecret);
		}
        else 
        {
			$this->token = null;
		}
	}


	/**
	 * Get a request_token from Weibo
	 *
	 * @return array a key/value array containing oauth_token and oauth_token_secret
	 */
	function getRequestToken($requestTokenUrl, $oauthCallback = null) {
		$parameters = array();
		if (!empty($oauthCallback)) {
			$parameters['oauth_callback'] = $oauthCallback;
		} 

		$request = $this->oAuthRequest($requestTokenUrl, 'GET', $parameters);
		$token = OAuthUtil::parseParameters($request);
		$this->token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret']);
		return $token;
	}

	/**
	 * Get the authorize URL
	 *
	 * @return string
	 */
	function getAuthorizeURL($authorizeUrl, $authenticateUrl = null, $token, $signInWithWeibo = true , $url)
    {
		if (is_array($token))
        {
			$token = $token['oauth_token'];
		}

		if (empty($signInWithWeibo))
        {
			return $authorizeUrl . "?oauth_token={$token}&oauth_callback=" . urlencode($url);
		}

        return $authenticateUrl . "?oauth_token={$token}&oauth_callback=". urlencode($url);
	}

	/**
	 * Exchange the request token and secret for an access token and
	 * secret, to sign API calls.
	 *
	 * @return array array("oauth_token" => the access token,
	 *                "oauth_token_secret" => the access secret)
	 */
	function getAccessToken($accessTokenUrl, $oauthVerifier = false, $oauthToken = false) {
		$parameters = array();
		if (!empty($oauthVerifier))
        {
			$parameters['oauth_verifier'] = $oauthVerifier;
		}


		$request = $this->oAuthRequest($accessTokenUrl, 'GET', $parameters);
		$token = OAuthUtil::parseParameters($request);
		$this->token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret']);
		return $token;
	}

	/**
	 * GET wrappwer for oAuthRequest.
	 *
	 * @return mixed
	 */
	function get($url, $parameters = array(), $formatPos = true)
    {
		$response = $this->oAuthRequest($url, 'GET', $parameters, false, $formatPos);
		if ($this->format === 'json' && $this->decodeJson)
        {
			return json_decode($response, true);
		}
		return $response;
	}

	/**
	 * POST wreapper for oAuthRequest.
	 *
	 * @return mixed
	 */
	function post($url, $parameters = array() , $multi = false, $formatPos = true)
    {
		$response = $this->oAuthRequest($url, 'POST', $parameters , $multi, $formatPos );
		if ($this->format === 'json' && $this->decodeJson)
        {
			return json_decode($response, true);
		}
		return $response;
	}

	/**
	 * DELTE wrapper for oAuthReqeust.
	 *
	 * @return mixed
	 */
	function delete($url, $parameters = array(), $formatPos = true)
    {
		$response = $this->oAuthRequest($url, 'DELETE', $parameters, false, $formatPos);
		if ($this->format === 'json' && $this->decodeJson)
        {
			return json_decode($response, true);
		}
		return $response;
	}

	/**
	 * Format and sign an OAuth / API request
	 *
	 * @return string
	 */
	function oAuthRequest($url, $method, $parameters , $multi = false, $formatPos = true)
    {

		if ($formatPos && strrpos($url, 'http://') !== 0 && strrpos($url, 'http://') !== 0)
        {
			$url = "{$this->host}{$url}.{$this->format}";
		}
        else
        {
            $url = "{$this->host}{$url}";
            $parameters['format'] = $this->format;
        }

		$request = OAuthRequest::fromConsumerAndToken($this->consumer, $this->token, $method, $url, $parameters);
		$request->signRequest($this->signatureMethod, $this->consumer, $this->token);
		switch ($method)
        {
            case 'GET':
                return $this->http($request->toUrl(), 'GET');
            default:
                return $this->http($request->getNormalizedHttpUrl(), $method, $request->toPostdata($multi), $multi);
		}
	}

	/**
	 * Make an HTTP request
	 *
	 * @return string API results
	 */
	function http($url, $method, $postfields = null, $multi = false)
    {
		$this->httpInfo = array();
		$ci = curl_init();
		/* Curl settings */
		curl_setopt($ci, CURLOPT_HTTP_VERSION,   CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_USERAGENT,      $this->userAgent);
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
		curl_setopt($ci, CURLOPT_TIMEOUT,        $this->timeout);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ci, CURLOPT_ENCODING,       "");
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->sslVerifypeer);
		curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
		curl_setopt($ci, CURLOPT_HEADER,         false);

		switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($postfields))
                {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                }
                break;
            case 'DELETE':
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($postfields))
                {
                    $url = "{$url}?{$postfields}";
                }
		}

		$header_array2 = array();
		if($multi)
        {
			$header_array2 = array(
                    "Content-Type: multipart/form-data; boundary=" . OAuthUtil::$boundary ,
                    "SaeRemoteIP: " . $_SERVER['REMOTE_ADDR'],
                    "Expect: ");
        }

		//if ( defined( 'SAE_FETCHURL_SERVICE_ADDRESS' ) ) {

		//	$header_array = array();

		//	$header_array["FetchUrl"] = $url;
		//	$header_array['TimeStamp'] = date('Y-m-d H:i:s');
		//	$header_array['AccessKey'] = SAE_ACCESSKEY;

		//	$content="FetchUrl";

		//	$content.=$header_array["FetchUrl"];

		//	$content.="TimeStamp";

		//	$content.=$header_array['TimeStamp'];

		//	$content.="AccessKey";

		//	$content.=$header_array['AccessKey'];

		//	$header_array['Signature'] = base64_encode(hash_hmac('sha256',$content, SAE_SECRETKEY ,true));

		//	curl_setopt($ci, CURLOPT_URL, SAE_FETCHURL_SERVICE_ADDRESS );

		//	//print_r( $header_array );
		//	foreach($header_array as $k => $v)
		//		array_push($header_array2,$k.': '.$v);
		//} else {
		//	curl_setopt($ci, CURLOPT_URL, $url );
		//}
        curl_setopt($ci, CURLOPT_URL, $url );

		curl_setopt($ci, CURLOPT_HTTPHEADER, $header_array2 );
		curl_setopt($ci, CURLINFO_HEADER_OUT, true );

		$response = curl_exec($ci);
		$this->httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);
		$this->httpInfo = array_merge($this->httpInfo, curl_getinfo($ci));
		$this->url = $url;

		curl_close ($ci);
		return $response;
	}

	/**
	 * Get the header info to store.
	 *
	 * @return int
	 */
	function getHeader($ch, $header)
    {
		$i = strpos($header, ':');
		if (!empty($i)) {
			$key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
			$value = trim(substr($header, $i + 2));
			$this->httpHeader[$key] = $value;
		}
		return strlen($header);
	}
}
