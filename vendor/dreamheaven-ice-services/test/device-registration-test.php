<?php
require __DIR__.'/../lib/DreamHeaven/Services/Loader.php';

$SERVICE_NAME = 'DeviceRegistrationI';
$SERVICE_TYPE = "::DreamHeaven::Services::DeviceRegistration";
$ENDPOINTS    = 'tcp -p 10000:udp -p 10000';

$prog = array_shift($argv);
$cmd  = array_shift($argv);

$cmd_func = "cmd_{$cmd}";
if(function_exists($cmd_func))
{
    $ICE = Ice\initialize();
    $prx = $ICE->stringToProxy("DeviceRegistrationI:tcp -p 10000:udp -p 10000");

    try
    {
        $prx = $prx->ice_checkedCast($SERVICE_TYPE);
        $cmd_func($prx, $argv);
        echo "cmd {$cmd} executed successfully\n";
    }
    catch (Exception $ex)
    {
        printf("error: \n%s\n", $ex);
    }
}
else
{
    show_usage();
}

function cmd_register($prx, $params)
{
    @list($user_id, $platform, $token) = $param;

    $user_id  = $user_id  ?: 'ice-services-device-registration-test-user-id';
    $platform = $platform ?: "android";
    $token    = $token    ?: uniqid('just-a-random-device-token:', true);

    printf("registering: user_id=%s, platform=%s, token=%s\n", $user_id, $platform, $token);

    $prx->register($user_id, $platform, $token);
}

function cmd_unregister($prx, $params)
{
    @list($platform, $token) = $params;

    printf("unregistering: platform=%s, token=%s\n", $platform, $token);

    $prx->unregister($platform, $token);
}

function cmd_suspend($prx, $params)
{
    @list($platform, $token, $reason) = $params;

    $reason = $reason ?: "just for test";
    printf("suspending: platform=%s, token=%s, reason=%s\n", $platform, $token, $reason);

    $prx->suspend($platform, $token, $reason);
}

function cmd_resume($prx, $params)
{
    @list($platform, $token) = $params;

    printf("resuming: platform=%s, token=%s\n", $platform, $token);

    $prx->resume($platform, $token);
}

function cmd_purge($prx, $params)
{
    printf("purging\n");

    $prx->purgeExpired();
}

function show_usage()
{
    global $prog;

    $usage = <<<EOF
{$prog} cmd [params]...

cmds:
    register    [userId] [platform] [token]     register a device

    unregister  <platform> <token>              unregister a device

    suspend     <platform> <token> [reason]     suspend a device

    resume      <platform> <token>              resume a device

    purge                                       purge all expired tokens

EOF;

    echo $usage;
}
