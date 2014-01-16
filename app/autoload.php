<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

$vendorDir = realpath(__DIR__.'/../vendor');
$baseDir   = dirname($vendorDir);

$loader = require $vendorDir.'/autoload.php';

$loader->add('DreamHeaven', array($vendorDir.'/dreamheaven/src', $vendorDir.'/dreamheaven-ice-services/lib'));
$loader->add('Knp\Bundle',  $vendorDir . '/bundles');
$loader->add('Knp\Menu',    $vendorDir . '/KnpMenu/src');
$loader->add('Lianz',       $vendorDir . '/bundles');

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->add('', __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs');
}

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
