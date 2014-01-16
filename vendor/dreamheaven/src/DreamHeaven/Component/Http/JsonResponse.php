<?php
namespace DreamHeaven\Component\Http;

use Symfony\Component\HttpFoundation\Response as BaseResponse;

/**
 * Response represents an HTTP response.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class JsonResponse extends BaseResponse
{
    /**
     * Constructor.
     *
     * @param string  $content The response content
     * @param integer $status  The response status code
     * @param array   $headers An array of response headers
     */
    public function __construct($content = '', $status = 200, $headers = array())
    {
        $headers = array_merge($headers, array('Content-Type' => 'application/json; charset=UTF-8'));
        if(is_array($content))
        {
            $content = json_encode($content);
        }

        parent::__construct($content, $status, $headers);
    }

}
