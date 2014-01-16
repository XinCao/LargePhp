<?php
namespace Lianz\SimpleFormBundle\Helper;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
use Lianz\SimpleFormBundle\Constants;
use Lianz\SimpleFormBundle\Validation\Registry;
use Symfony\Component\DependencyInjection\ContainerInterface;
// </editor-fold>

class ValidationHelper
{
    public static function parseValidator(ContainerInterface $container, $valicatorInfo)
    {
        $cachedValidators = Registry::getRegistry(Constants::VALIDATOR_INSTANCES);
        $cachedArgs       = Registry::getRegistry(Constants::VALIDATOR_INSTANCE_ARGS);
        $customValidators = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        return self::getCachedObject($container, $valicatorInfo, $cachedValidators, $cachedArgs, $customValidators, 'validators');
    }

    public static function parseProcessor(ContainerInterface $container, $processorInfo)
    {
        $cachedValidators = Registry::getRegistry(Constants::PROCESSOR_INSTANCES);
        $cachedArgs       = Registry::getRegistry(Constants::PROCESSOR_INSTANCE_ARGS);
        $customValidators = Registry::getRegistry(Constants::CUSTOM_PROCESSORS);

        return self::getCachedObject($container, $processorInfo, $cachedValidators, $cachedArgs, $customValidators, 'processors');
    }

    private static function parseInfo($info)
    {
        static $pattern = "/^([a-z0-9_-]+)\[(.+?)\]$/i";

        $info = trim($info);
        if(preg_match($pattern, $info, $matches))
        {
            $name = $matches[1];
            $args = $matches[2];
        }
        else
        {
            $name = $info;
            $args = null;
        }

        return array($name, $args);
    }

    // do some dirty work here
    private static function getCachedObject($container, $info, $cachedInctances, $cachedArgs, $customObjects, $serviceCatetory)
    {
        if(is_callable($info))
        {
            return array($info, null);
        }

        list($objectName, $args) = self::parseInfo($info);

        if($cachedInctances->has($info))
        {
            $cachedObject = $cachedInctances->get($info);
            $cachedArgs   = $cachedArgs->get($info);
            return array($cachedObject, $cachedArgs);
        }

        if($customObjects->has($info))
        {
            $customObject = $customObjects->get($info);

            $cachedInctances->set($info, $customObject);
            $cachedArgs->set($info, null);

            return array($customObject, null);
        }

        $object = null;
        $buildinObjectServiceName   = "simple_form.{$serviceCatetory}.buildins.{$objectName}";
        $buildinObjectFqcnParameter = "simple_form.{$serviceCatetory}.buildins.{$objectName}.class";
        $customObjectServiceName    = "simple_form.{$serviceCatetory}.custom.{$objectName}";
        $customObjectFqcnParameter  = "simple_form.{$serviceCatetory}.custom.{$objectName}.class";

        if($container->has($buildinObjectServiceName))
        {
            $object = $container->get($buildinObjectServiceName);
        }
        elseif($container->has($customObjectServiceName))
        {
            $object = $container->get($customObjectServiceName);
        }
        elseif($container->hasParameter($buildinObjectFqcnParameter))
        {
            $processorFQCN = $container->getParameter($buildinObjectFqcnParameter);
            $object = new $processorFQCN($args);
        }
        elseif($container->hasParameter($customObjectFqcnParameter))
        {
            $processorFQCN = $container->getParameter($customObjectFqcnParameter);
            $object = new $processorFQCN($args);
        }

        if($object)
        {
            $cachedInctances->set($info, $object);
            $cachedArgs->set($info, $args);
        }

        return array($object, $args);
    }
}
