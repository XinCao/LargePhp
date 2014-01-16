<?php

namespace DreamHeaven\AdminBundle\Helper;

class FormHelper {
    private static $flashBag;

    public static function init($flashBag) {
        self::$flashBag = $flashBag;
    }
    
    /**
     * 
     * @abstract 对输入的 ID 和 Name 进行数量上的检查
     */
    public static function checkPlayerInfos($playerIdsStr, $playerNamesStr) {
        $ok = true;
        $playerIdsStr = str_replace(",", ' ', $playerIdsStr);
        $playerIds = array_filter(preg_split('/\s+/', $playerIdsStr));
        if (!$playerIds) {
            self::$flashBag->add('error', '请输入合法的玩家ID');
            $ok = false;
        }
        $playerNamesStr = str_replace(",", ' ', $playerNamesStr);
        $playerNames = array_filter(preg_split('/\s+/', $playerNamesStr));
        if (!$playerNames) {
            self::$flashBag->add('error', '请输入合法的玩家名字');
            $ok = false;
        }
        $playerInfos = array();
        if (count($playerIds) != count($playerNames)) {
            self::$flashBag->add('error', '玩家ID数量和玩家名字数量不匹配');
            $ok = false;
        } else {
            $playerInfos = array_combine($playerIds, $playerNames);
        }
        return $ok ? $playerInfos : false;
    }

//
//    public static function createServerPreprocessor($serverList)
//    {
//        $processor = function($realm) use($serverList){
//            if($realm == 'ALL')
//            {
//                return 'ALL';
//            }
//
//            $realms = (array)$realm;
//            $filteredServerList = array_filter($serverList, function($s) use($realms) { return in_array($s['id'], $realms); });
//            $ok = !(empty($filteredServerList) || empty($realms) || count($filteredServerList) !== count($realms));
//            if(!$ok)
//            {
//                return false;
//            }
//
//            return $realm;
//        };
//
//        return $processor;
//    }

    public static function createServerValidator($realms) {
        $validator = function($realm) use($realms) {
            if ($realm === 'ALL') {
                return array(true, '');
            }
            if (!$realm) {
                return array(false, 'admin_bundle.validator_errors.valid_server');
            }
            $realms = (array) $realm;
            $filteredServerList = array_filter($realms, function($s) use($realms) {
                return in_array($s['id'], $realms);
            });
            $ok = !(empty($filteredServerList) || count($filteredServerList) !== count($realms));
            return $ok ? array(true, '') : array(false, 'admin_bundle.validator_errors.valid_server');
        };
        return $validator;
    }
    
    /**
     * @abstract 检查服务器是否存在
     * @param array $realmIds
     * @param array $serverList
     * @return boolean
     */
    public static function checkServer($realmIds, $serverList) {
        $ok = true;
        $realmIds = (array) $realmIds;
        $filteredRealmList = array_filter($serverList, function($s) use($realmIds) {
                    return in_array($s['id'], $realmIds);
                });
        if (empty($filteredRealmList) || empty($realmIds) || count($filteredRealmList) !== count($realmIds)) {
            self::$flashBag->add('error', '请先选择服务器');
            $ok = false;
        }
        return $ok ? $filteredRealmList : false;
    }

    /**
     * 
     * @param String  $note
     * @return boolean
     */
    public static function checkNote($note) {
        $ok = true;
        if (mb_strlen($note) < 5) {
            self::$flashBag->add('error', '操作理由不能为空，并且最少为 5 个字');
            $ok = false;
        }
        return $ok ? $note : false;
    }

}
