<?php
namespace DreamHeaven\Component\Http\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class InvalidRequestHttpException extends HttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(400, $message, $previous, array(), $code);
    }
}
