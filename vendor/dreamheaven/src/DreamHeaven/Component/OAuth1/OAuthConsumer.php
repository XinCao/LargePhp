<?php
namespace DreamHeaven\Component\OAuth1;

class OAuthConsumer
{

	public $key;
	public $secret;

	function __construct($key, $secret)
    {
		$this->key = $key;
		$this->secret = $secret;
	}

	function __toString()
    {
		return "OAuthConsumer[key=$this->key,secret=$this->secret]";
	}
}
