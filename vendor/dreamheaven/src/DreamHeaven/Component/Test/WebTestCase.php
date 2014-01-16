<?php
namespace DreamHeaven\Component\Test;

abstract class WebTestCase extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    protected $container = null;

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

        $kernel->boot();
        $this->container = $kernel->getContainer();

        return $kernel;
    }

    protected function getKernelClass()
    {
        throw new \NotImplementedException('请自行重载此函数，返回正确的 Kernel 类');
    }
}
