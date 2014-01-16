<?php
namespace DreamHeaven\AdminBundle\Test;

require_once __DIR__.'/../../../../app/bootstrap.php.cache';
require_once __DIR__.'/AdminTestKernel.php';

abstract class WebTestCase extends \DreamHeaven\Component\Test\WebTestCase
{
    protected $oauthTokens = array();

    protected function getKernelClass()
    {
        return 'DreamHeaven\AdminBundle\Test\AdminTestKernel';
    }
}
