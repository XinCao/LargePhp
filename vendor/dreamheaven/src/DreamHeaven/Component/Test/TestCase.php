<?php
namespace DreamHeaven\Component\Test;

use Symfony\Component\Locale\Exception\NotImplementedException;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $kernel = null;
    protected $container = null;

    public function __construct()
    {
        parent::__construct();

        $this->kernel = $this->createKernel();
        $this->kernel->loadClassCache();
        $this->container = $this->kernel->getContainer();
    }

//    public static function getContainer()
//    {
//        $kernel = new \TestKernel('test', false);
//        $kernel->loadClassCache();
//        $container = $kernel->getContainer();
//
//        return $container;
//    }

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

        return $kernel;
    }


    protected function getKernelClass()
    {
        throw new NotImplementedException('请自行重载此函数，返回正确的 Kernel 类');
    }
}
