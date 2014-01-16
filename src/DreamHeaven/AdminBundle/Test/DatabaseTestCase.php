<?php
namespace DreamHeaven\AdminBundle\Test;

require_once __DIR__.'/../../../../app/bootstrap.php.cache';
require_once __DIR__.'/AdminTestKernel.php';

class DatabaseTestCase extends DreamHeaven\CoreBundle\Test\DatabaseTestCase
{
    protected $kernel = null;
    protected $container = null;

    public function __construct()
    {
        parent::__construct();

        $this->kernel = new AdminTestKernel('test', false);
        $this->kernel->loadClassCache();
        $this->container = $this->kernel->getContainer();
    }
}
