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
        $content = "";
        foreach ($columnNames as $row) {
            $content.=$row . '\t';
        }
        $content.='\n';
        foreach ($rows as $row) {
            foreach ($row as $i) {
                $content.= $i . '\t';
            }
            $content.='\n';
        }
        $jsonResponse->create($content);
        return $jsonResponse;
    }

}