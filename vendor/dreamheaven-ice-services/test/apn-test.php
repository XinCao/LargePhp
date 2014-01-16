<?php
$begin = microtime(true);
require_once 'Ice_ns.php';
require_once __DIR__.'/../lib/DreamHeaven/Services/Loader.php';

use DreamHeaven\Services\ApplePushNotificationPrxHelper;

$ICE = Ice\initialize();

try
{
    $p = $ICE->stringToProxy("ApplePushNotificationI:tcp -p 10000:udp -p 10000");
     $p = $p->ice_datagram();
    $apn = ApplePushNotificationPrxHelper::uncheckedCast($p);

    $msg = isset($argv[1]) ? $argv[1] : 'hello push!';
    $payload = array('aps' => array('badge' => 9, 'alert' => $msg), 'custom1' => 'value1', 'custom2' => 'value2');
    $token = 'a15108f2 48b13b95 33ad7fc4 72f11c2e 967d6e70 18b56328 77a46d55 c7db3faa';
    $token = str_replace(" ", '', $token);
    $apn->pushMessage($token, json_encode($payload));

    $batchpayload = array('aps' => array('badge' => 9, 'alert' => "batch: ".$msg), 'custom1' => 'value1', 'custom2' => 'value2');
    $apn->batchPushMessages(array($token), json_encode($batchpayload));

    $end = microtime(true);
    echo "OK, cost=" . ($end-$begin) . "\n";
}
catch(Ice\LocalException $ex)
{
    print_r($ex);
}
