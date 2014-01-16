<?php
/**
 * This code can be applied to Mocaman
 * @author Xin Cao 
 */
namespace DreamHeaven\AdminBundle\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;

class xlsHelper {

    /*
     * 功能：把array转为xls
     * 参数：$columnNames 列名， $data 数组 格式为 array(array(),array(),array(),array(),array(),array()), $response 响应对象
     * 返回：返回xls的响应对象
     */
    public static function getXlsFromArray($columnNames, $rows, JsonResponse $jsonResponse) {
        $header = "";
        foreach ($columnNames as $row) {
            $header.=$row . '\t';
        }
        $header.='\n';
        foreach ($rows as $row) {
            $data = null;
            foreach ($row as $i) {
                $data.=(String) $i . '\t';
            }
            $data.='\n';
            $header.=$data;
        }
        $jsonResponse->create($header);
        return $jsonResponse;
    }
}