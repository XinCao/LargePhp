<?php
namespace DreamHeaven\AdminBundle\Service;

use DreamHeaven\AdminBundle\Helper\PaginationHelper;
use Exception;
use PDO;
use stdClass;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class OperationLoggingService {
    protected $userMan;
    protected $dbalConn;
    protected $urlFetchService;
    protected $logger;
    private $opNames = array(
        'broadcast.send'               => '发送系统公告',
         'maintain_mode.enter'         => '进入维护模式',
        'maintain_mode.leave'          => '退出维护模式',
        'white_list.add'               => '添加白名单',
        'black_list.add'               => '添加黑名单',
        'black_list.remove'            => '删除黑名单',
        'speech_list.add'              => '添加禁言名单',
        'speech_list.remove'           => '删除禁言名单',
        'rankingListShielding.add'     => '排行榜屏蔽玩家',
        'rankingListShielding.remove'  => '排行榜激活玩家',
        'refresh_billboard'            => '刷新排行榜',
        'refresh_activitylist'         => '刷新活动表',
        'player.kick'                  => '踢玩家下线',
         'player.kick_all'             => '踢所有玩家下线',
        'player.send_mail'             => '给玩家发送邮件',
        'data_manipulate'              => '修改玩家数据',
    );

    public function __construct($userMan, $dbalConn, $securityContext, LoggerInterface $logger = null) {
        $this->userMan     = $userMan;
        $this->dbalConn    = $dbalConn;
        $this->logger      = $logger;
        $this->currentUser = $securityContext->getToken()->getUser();
    }

    /**
     *
     * @param type $op
     * @param type $category
     * @param type $op_result
     * @param type $note
     * @param type $data
     * @param type $result
     */
    public function addLog($op_result, $op, $category, $note = '', $data = '', $result = '', $serverInfos = array(), $content = '') {
        $op_result = is_bool($op_result) ? ($op_result ? 'success' : 'error') : $op_result;
        $entry               = new stdClass();
        $entry->user_id      = $this->currentUser->id;
        $entry->username     = $this->currentUser->username;
        $entry->display_name = $this->currentUser->display_name;
        $entry->category     = $category;
        $entry->op           = $op;
        $entry->op_result    = $op_result;
        $entry->content      = $content;
        $entry->note         = $note;
        $entry->data         = is_array($data)   || is_object($data) ? json_encode($data)   : $data;
        $entry->result       = is_array($result) || is_object($data) ? json_encode($result) : $result;
        $entry->servers      = is_array($serverInfos) || is_object($serverInfos) ? json_encode($serverInfos) : $serverInfos;
        $entry->created_at   = time();
        try {
            $this->dbalConn->insert('operation_logs', get_object_vars($entry));
        }catch (Exception $e) {
            $this->logger->err($e->getTraceAsString());
        }
    }

    public function getLogs($opList, $offset = 0, $limit = 20) {
        $opList = (array)$opList;
        $opList = array_map(function($op){ return "'{$op}'"; }, $opList);
        $opListStr = join(', ', $opList);
        $where = $opList ? "WHERE op in ({$opListStr})" : '';
        $sql = "SELECT count(*) FROM operation_logs {$where} ORDER BY created_at DESC";
        $cursor = $this->dbalConn->query($sql);
        $total = (int)$cursor->fetchColumn();
        $entries = array();
        if($total) {
            $fields = 'id, user_id, content, note, servers, op, op_result, result, created_at';
            $sql = "SELECT {$fields} FROM operation_logs {$where} ORDER BY created_at DESC LIMIT {$limit} OFFSET {$offset}";
            $cursor = $this->dbalConn->query($sql);
            $entries = $cursor->fetchAll(PDO::FETCH_ASSOC);
            foreach ($entries as &$entry) {
                $op = $entry['op'];
                $entry['op_name'] = isset($this->opNames[$op]) ? $this->opNames[$op] : $op;
                $entry['server_names'] = '';
                $servers     = json_decode($entry['servers'], true);
                if( is_array($servers)){
                    $serverNames = array_map(
                            function($s){
                                if(isset($s['realm']) && isset($s['name'])){
                                    return isset($s['full_name'])  ? $s['full_name'] : "({$s['realm']}服) {$s['name']}";
                                    
                                }else{
                                    return '';
                                }
                            }, 
                    $servers);
                }else{
                    $serverNames = '';
                }
                if($serverNames != ''){
                    $entry['server_names'] = join(', ', $serverNames);
                }
                $entry['servers'] = $servers;
                $entry['user'] = $this->userMan->findUserBy(array('id' => $entry['user_id']));
                $entry['result'] = json_decode($entry['result'], true);
            }
        }
        $data = array('entries' => $entries);
        $pagingInfo = PaginationHelper::getPagingInfo($total, $limit, $offset);
        if($pagingInfo != null) {
            $data['paging'] = $pagingInfo;
        }
        return $data;
    }
}
