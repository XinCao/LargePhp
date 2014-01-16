<?php
namespace DreamHeaven\Services;

require 'Ice_ns.php';

require __DIR__.'/Util.php';
require __DIR__.'/ApplePushNotificationService.php';
require __DIR__.'/DeviceRegistry.php';
require __DIR__.'/GoogleCloudMessaging.php';

// 这个 Loader 只是做一个样子而已，目的是为了运行上面的几个 require_once
class Loader
{
    public static function autoload()
    {
    }
}
