<?php
namespace Lianz\SimpleFormBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class LianzSimpleFormExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $csrfEnabled = $container->getParameter('form.type_extension.csrf.enabled');
        if($csrfEnabled)
        {
            $loader->load('csrf_validator.xml');
        }
    }
}
