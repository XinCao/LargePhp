<?php
namespace Lianz\SimpleFormBundle\Tests;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class TestKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
//            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
//            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Lianz\SimpleFormBundle\LianzSimpleFormBundle(),
        );

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__.'/var';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        ;
    }
}
