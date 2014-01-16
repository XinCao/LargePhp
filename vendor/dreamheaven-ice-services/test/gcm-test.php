<?php

$begin = microtime(true);
require_once 'Ice_ns.php';
require_once __DIR__.'/../../../target/php/Loader.php';

use DreamHeaven\Services\GoogleCloudMessagingPrxHelper;

$ICE = Ice\initialize();

try
{
    $p = $ICE->stringToProxy("GoogleCloudMessagingI:tcp -h 192.168.0.200 -p 10000:udp -h 192.168.0.200 -p 10000");
//    $p = $p->ice_datagram();
    $gcm = GoogleCloudMessagingPrxHelper::uncheckedCast($p);

    $msg = isset($argv[1]) ? $argv[1] : 'hello push!';
    $payload = array('badge' => "2/3", 'alert' => $msg, );
    $extras = array('custom-attr1' => 'value1', 'custom-attr2' => 'value2');
    //$token = 'd37e514e 6110448b f09d243e d2203fe3 038167e9 b040c1ba 77ddfddd b5f556a';
    //$token = 'APA91bFsUXsW_fNrq494AjhgilG7ij8mM-Cwt8J5Oa40P1u98qeG_sPQXVdT-h5Bbek_tiN2jCtqQDtzQhM4On70duhcdyQS0w3GLbhwdleuOimsx5ftZ_6HtXSyweLXKQ_7ZohRuYxd0nstfSPWe7rAtM4I2X_TTA';
    $token = 'APA91bGjeXbWuUtXN8RegYOe02BmhAPC0zZRlizDmVV7xv65D0kaR5HDOMAIg0KDNGQjMkTsl76_axVnq6PiVyuFPzfB-p9qphyRF40R-Py_H0JOtShKPxXhITS2YXrBp23LvuQBD0BX';

    $token = str_replace(" ", '', $token);
    $gcm->pushMessage($token, $payload, $extras);
//     $gcm->batchPushMessage(array($token), $payload, $extras);

    $end = microtime(true);
    echo "OK, cost=" . ($end-$begin) . "\n";
}
catch(Ice\LocalException $ex)
{
    print_r($ex);
}
