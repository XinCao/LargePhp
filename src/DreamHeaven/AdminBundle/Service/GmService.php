<?php
namespace DreamHeaven\AdminBundle\Service;

use Exception;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class GmService {
    protected $dbalConn;
    protected $urlFetchService;
    protected $logger;

    public function __construct($dbalConn, $urlFetchService, $securityContext, LoggerInterface $logger = null) {
        $this->dbalConn        = $dbalConn;
        $this->urlFetchService = $urlFetchService;
        $this->logger          = $logger;
    }

    /**
     * 
     * @return array 服务器列表信息
     */
    public function getAllRealms() {
        $sql = "SELECT * FROM realms";
        return $this->fetchRealms($sql);
    }
    
    /**
     * 
     * @param String $platform
     * @return array 指定平台的服务器列表信息
     */
    public function getRealms($platform = '') {
        $platform = str_replace('_', '-', $platform);
        $sql = "SELECT * FROM realms WHERE platform='{$platform}' ORDER BY realm_num";
        return $this->fetchRealms($sql);
    }
    
    private function fetchRealms($sql) {
        $rows = $this->dbalConn->fetchALl($sql);
        $realms = array();
        foreach ($rows as $realm) {
            $id = $realm['id'];
            $realms[$id] = array(
                'id' => $id, 
                'realm' => $realm['realm_num'], 
                'name' => $realm['name'],
                'full_name' => "({$realm['realm_num']} 服) {$realm['name']}", 
                'address' => $realm['address'],
                'host' => $realm['mgmt_address'],
                'type' => (int)$realm['type']);
        }
        return $realms;
    }

    public function getPlayerNameById($serverHost, $playerId) {
        list($succeed, $playerName) = $this->invokeJmxMethod($serverHost, 'getPlayerNameById', array('player_id' => (int) $playerId));

        return $succeed ? $playerName : null;
    }

    public function getPlayerIdByName($serverHost, $playerName) {
        list($succeed, $playerId) = $this->invokeJmxMethod($serverHost, 'getPlayerIdByName', array('player_name' => $playerName));

        return $succeed ? $playerId : null;
    }

    public function getPlayerBriefInfoById($serverHost, $playerId) {
        $timeout = 5;
        list($succeed, $info) = $this->invokeJmxMethod($serverHost, 'getPlayerBriefInfoById', array('player_id' => (int) $playerId), $timeout);

        $begin   = microtime(true);
        $decoded = @json_decode($info, true);
        $cost0   = microtime(true) - $begin;

        return $decoded;
    }

    public function getPlayerInfoById($serverHost, $playerId, $mask) {
        $timeout = 5;
        list($succeed, $info) = $this->invokeJmxMethod($serverHost, 'getPlayerInfo', array('player_id' => (int) $playerId,
            'mask'      => (int) $mask), $timeout);

        $begin   = microtime(true);
        $decoded = @json_decode($info, true);
        $cost0   = microtime(true) - $begin;

        return $decoded;
    }

    public function getPlayerSkillInfoById($serverHost, $playerId) {
        $timeout = 5;
        list($succeed, $info) = $this->invokeJmxMethod($serverHost, 'getPlayerSkillInfo', array('player_id' => (int) $playerId), $timeout);

        $begin   = microtime(true);
        $decoded = @json_decode($info, true);
        $cost    = microtime(true) - $begin;
        return $decoded;
    }

    public function getConcurrentUsers($serverHost) {
        list($succeed, $num) = $this->invokeJmxMethod($serverHost, 'getOnlinePlayer', array('dummy' => 1));

        return $succeed ? $num : 'ERROR';
    }

    public function sendBroadcast($serverHost, $content) {
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'broadcast', array('content' => $content));

        return $succeed;
    }

    /*
     * @ManagedOperationParameter(name = "contents", description = "公告内容"),
     * @ManagedOperationParameter(name = "interval", description = "公告间隔（单位是秒）"),
     * @ManagedOperationParameter(name = "startsAt", description = "公告开始时间（单位是秒）"),
     * @ManagedOperationParameter(name = "duration", description = "公告有效时间（单位是秒）")
     */

    public function scheduleBroadcast($serverHost, $content, $interval, $startsAt, $duration) {
        $data = array('content'  => $content, 'interval' => $interval, 'startsAt' => $startsAt, 'duration' => $duration);
        list($succeed, $broadcastId) = $this->invokeJmxMethod($serverHost, 'scheduleBroadcast', $data);

        return $broadcastId;
    }

    /*
     * @ManagedOperation(description = "取消一个已设置的公告")
     * @ManagedOperationParameters({@ManagedOperationParameter(name = "id", description = "公告ID")})
     */

    public function unscheduleBroadcast($serverHost, $broadcastId) {
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'unscheduleBroadcast', array('id' => (int) $broadcastId));
        return $succeed;
    }

    /*
     * 未完成
     *
     *
     */

    //参数1.ip, 参数2.填充的内容，参数3.位置
    public function loginAnnouncement($serverHost, $content, $flag) {
        list($secceed, $_) = $this->invokeJmxMethod($serverHost, 'loginAnnouncement', array('content' => $content, 'flag'    => $flag));
        return $secceed;
    }

    /*
     * 未完成
     *
     *
     */

    //参数1.ip， 参数2.操作，（0：关， 1开）， 参数3， （标志位，决定某个活动）
    public function switchActivityManagement($serverHost, $operation, $flag) {
        list($secceed, $_) = $this->invokeJmxMethod($serverHost, ' switchActivity', array('operation' => $operation, 'flag'      => $flag));
        return $secceed;
    }

    /*
     * 未完成的接口
     * 参数1.ip, 参数2.操作， （0:下架， 1：上架）， 参数3.物品Id
     */

    public function upDownItemManagement($serverHost, $operation, $itemId) {
        list($secceed, $_) = $this->invokeJmxMethod($serverHost, 'upDownItem', array('operation' => $operation, 'itemId'    => $itemId));
        return $secceed;
    }

    public function sendMail($serverHost, $mailInfo) {
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'sendMail', $mailInfo);
         
        return $succeed;
    }
    
    public function sendAllRealmsMail($serverHost, $mailInfo){
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'sendAllRealmsMail', $mailInfo);
         
        return $succeed;
    }
    
    public function getMaxPlayerId($serverHost){
        list($succeed, $maxPlayerId) = $this->invokeJmxMethod($serverHost, 'getMaxPlayerId');
        
        return $maxPlayerId;
    }

    public function kickPlayerById($serverHost, $playerId, $reason) {
        $data = array('player_id' => (int) $playerId, 'reason'    => $reason);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'kickOutByPlayerObjId', $data);

        return $succeed;
    }

    public function addTestAccount($serverHost, $playerId) {
        $data = array('player_id' => (int) $playerId);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'addTestAccount', $data);

        return $succeed;
    }

    public function addTestAccountByAccountId($serverHost, $accountId) {
        $data = array('account_id' => "{$accountId}");
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'addTestAccountByAccountId', $data);

        return $succeed;
    }

    public function kickAllPlayers($serverHost) {
        $data = array('dummy' => 0);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'kickAllPlayers', $data);

        return $succeed;
    }

    public function switchMaintainMode($serverHost, $on) {
        $data = array('on' => (int) $on);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'switchMaintainMode', $data);

        return $succeed;
    }

    // 刷新排行榜
    public function refreshBillboard($serverHost) {
        $data = array('dummy' => 1);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'flushBillBroad', $data);

        return $succeed;
    }

    public function refreshActivityList($serverHost) {
        $data = array('dummy' => 1);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'reloadActiveTable', $data);

        return $succeed;
    }

    // 把玩家添加到黑名单（添加后不能登录）
    public function banAccount($serverHost, $playerId) {
        $data = array('player_id' => (int) $playerId);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'addBanedAccount', $data);

        return $succeed;
    }

    // 把玩家从黑名单移除（移除后能登录）
    public function unbanAccount($serverHost, $playerId) {
        $data = array('player_id' => (int) $playerId);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'delBanedAccount', $data);

        return $succeed;
    }

    //对玩家进行禁言操作$action 1.表示禁言 2.解除
    public function speechOperation($serverHost, $playerId, $action) {
        $data = array('player_id' => (int) $playerId, 'action'    => $action);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'setDonttalk', $data);

        return $succeed;
    }

    //排行胖屏蔽和激活玩家 1.表示禁止 2.表示解除
    public function rankingListBlocked($serverHost, $playerId, $action) {
        $data = array('player_id' => (int) $playerId, 'action'    => $action);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'setBanRanking', $data);

        return $succeed;
    }

    // 设置玩家等级
    public function setPlayerLevel($serverHost, $playerId, $level) {
        $data = array('player_id' => (int) $playerId, 'level'     => (int) $level);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'setPlayerLevel', $data);

        return $succeed;
    }

    // 设置玩家 VIP 等级
    public function setPlayerVipLevel($serverHost, $playerId, $vipLevel) {
        $data = array('player_id' => (int) $playerId, 'vip_level' => (int) $vipLevel);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'setPlayerVipLevel', $data);

        return $succeed;
    }

    //设置玩家技能品质
    public function setPlayerSkillExp($serverHost, $playerId, $skillExp) {
        $data = array('player_id' => (int) $playerId, 'skill_exp' => (int) $skillExp);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'setPlayerSkillExp', $data);

        return $succeed;
    }

    //设置玩家强化等级
    public function setPlayerForceLevel($serverHost, $playerId, $forceLevel) {
        $data = array('player_id'   => (int) $playerId, 'force_level' => (int) $forceLevel);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'setPlayerForceLevel', $data);

        return $succeed;
    }

    //设置玩家吞噬等级
    public function setPlayerSwallowLevel($serverHost, $playerId, $swallowLevel) {
        $data = array('player_id'   => (int) $playerId, 'force_level' => (int) $swallowLevel);
        list($succeed, $_) = $this->invokeJmxMethod($serverHost, 'setPlayerSwallowLevel', $data);

        return $succeed;
    }

    public function invokeJmxMethod($serverHost, $methodName, $params = array(), $timeout = 1) {
        $url = "http://{$serverHost}/invoke";

        $headers                 = array();
        $jmxParams['operation']  = $methodName;
        $jmxParams['objectname'] = "JmxTest:name=RuntimeInfo";

        $i = 0;
        foreach ($params as $key => $value) {
            $jmxParams["value{$i}"] = $value;
            $jmxParams["type{$i}"]  = $this->getJmxParamType($value);
            $i++;
        }

        try {
            $begin    = microtime(true);
            $options  = array('connect_timeout' => 1, 'timeout'         => 3);
            $response = $this->urlFetchService->post($url, $jmxParams, $headers, $options);
            $cost     = microtime(true) - $begin;

            if (!$response) {
                return array(false, null);
            }

            $xml    = simplexml_load_string($response->getBody());
            $attrs  = $xml->Operation->attributes();
            $result = $attrs->result;
            $return = (string) $attrs->return;
        } catch (Exception $ex) {
            $result = "error";
            $return = null;
            $this->logger->err($ex->getTraceAsString());
        }

        return array($result == "success", $return);
    }

    public function getJmxParamType($value) {
        if (is_string($value))
            return 'java.lang.String';
        elseif (is_int($value))
            return 'int';
        else
            throw new Exception("Unknow value type. supported types is: string, int, given type: " . gettype($value));
    }

}
