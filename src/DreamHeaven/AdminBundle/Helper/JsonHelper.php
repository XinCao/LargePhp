<?php
/**
 * This code can be applied to Mocaman
 * @author Xin Cao 
 */
namespace DreamHeaven\AdminBundle\Helper;

use DreamHeaven\AdminBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class jsonHelper extends BaseController {
    
    public static function databaseTableTransformJsonFile(JsonResponse $josnResponse, $databaseName=null){
        $array=$this->readDatabase($databaseName);
        $json = json_encode($array);
        /* @var $jsonResponse JsonResponse */
        $jsonResponse->create($json);
        return $josnResponse;
    }
    
    private function readDatabase($databaseName=null){
        $sql=<<<EOF
            SELECT
                *
            FROM
            {$databaseName}
EOF;
        $conn=$this->get('doctrine.dbal.game_logs_connection');
        $data=$conn->fetchAll($sql);
        return $data;        
    }

    /*
     * 功能：读取json文件，返回数组.
     * 参数：josnfile文件的路径和文件名
     */
    public static function jsonFileToArray($josnFile){
        $str = file_get_contents($josnFile);
        $array = json_decode($str);
        return $array;
    }
}