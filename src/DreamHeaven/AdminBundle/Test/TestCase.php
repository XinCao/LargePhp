<?php
namespace DreamHeaven\AdminBundle\Test;

require_once __DIR__.'/../../../../app/bootstrap.php.cache';
require_once __DIR__.'/AdminTestKernel.php';

class TestCase extends DreamHeaven\Component\Test\TestCase
{
    protected function getKernelClass()
    {
        return 'DreamHeaven\AdminBundle\Test\AdminTestKernel';
    }
}
