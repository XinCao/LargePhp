<?php
namespace DreamHeaven\Component\Test;

abstract class DatabaseTestCase extends \PHPUnit_Extensions_Database_TestCase
{
    protected $kernel = null;
    protected $container = null;

    public function __construct()
    {
        parent::__construct();

        $this->kernel = new \TestKernel('test', false);
        $this->kernel->loadClassCache();
        $this->container = $this->kernel->getContainer();
    }

    /**
     * Creates a Kernel.
     *
     * Available options:
     *
     *  * environment
     *  * debug
     *
     * @param array $options An array of options
     *
     * @return HttpKernelInterface A HttpKernelInterface instance
     */
    protected function createKernel(array $options = array())
    {
        $class = $this->getKernelClass();

        $kernel = new $class(
            isset($options['environment']) ? $options['environment'] : 'test',
            isset($options['debug']) ? $options['debug'] : true
        );

        $this->container = $kernel->getContainer();

        return $kernel;
    }


    protected function getKernelClass()
    {
        throw new \NotImplementedException('请自行重载此函数，返回正确的 Kernel 类');
    }

}
