<?php
namespace DreamHeaven\Component\OAuth1\SignatureMethod;

use DreamHeaven\Component\OAuth1\OAuthUtil;

class OAuthSignatureMethodHmacSha1 extends AbstractOAuthSignatureMethod
{
	function getName()
    {
		return "HMAC-SHA1";
	}

	public function buildSignature($request, $consumer, $token)
    {
		$baseString = $request->getSignatureBaseString();
		$request->baseString = $baseString;

		$keyParts = array(
			$consumer->secret,
			($token) ? $token->secret : ""
		);

		$keyParts = OAuthUtil::urlencodeRfc3986($keyParts);
		$key = implode('&', $keyParts);

		return base64_encode(hash_hmac('sha1', $baseString, $key, true));
	}
}
