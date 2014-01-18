<?php

namespace DreamHeaven\AdminBundle\Helper;

class PaginationHelper {
    /**
     * 
     * @abstract 还是存在逻辑问题
     */
    public static function paginateArray(array $objects, $offset, $limit, $reverseKey = true) {
        if (isset($objects['hash'])) {
            unset($objects['hash']);
        }
        $total = count($objects);
        $paged = array_slice($objects, $offset, $limit, $reverseKey);
        $data = array('count' => $total, 'data' => $paged);
        $pagingInfo = self::getPagingInfo($total, $limit, $offset);
        if ($pagingInfo) {
            $data['paging'] = self::getPagingInfo($total, $limit, $offset);
        }
        return $data;
    }

    /**
     * 
     * @abstract 分页，上下文参数信息 
     * $total  总数据函数
     * $limit  每次读取信息的行数
     * $offset 读取信息开始的位置
     */
    public static function getPagingInfo($total, $limit = null, $offset = null) {
        $limit = (int) ($limit ? : $total);
        $offset = (int) $offset;
        $pagingInfo = null;
        if ($offset > 0) {
            $pagingInfo['prev'] = array('offset' => max($offset - $limit, 0), 'limit' => $limit);
        }
        if ($total > $offset + $limit) {
            $pagingInfo['next'] = array('offset' => max($offset + $limit, 0), 'limit' => $limit);
        }
        return $pagingInfo;
    }

    /**
     * 
     * $total        总数据行数
     * $pageSize     每个页面显示的信息函数
     * $pageSize     当前的页码
     * $pageName     通过这个参数，来获得请求的页码 
     */
    public static function paginateHtml($url, $total, $pageSize, $currentPage, $pageName = 'page') {
        $html = '';
        $url .= strpos($url, '?') ? '&' : '?';
        if ($total <= $pageSize) {
            return $html;
        }
        $offset = 5;
        $showPageCount = 10;
        $totalPage = ceil($total / $pageSize);
        if ($showPageCount > $totalPage) {
            $from = 1;
            $to = $totalPage;
        } else {
            $from = $currentPage - $offset;
            $to = $currentPage + $showPageCount - $offset - 1;
            if ($from < 1) {
                $to = $currentPage + 1 - $from;
                $from = 1;
                if (($to - $from) < $showPageCount && ($to - $from) < $totalPage) {
                    $to = $showPageCount;
                }
            } elseif ($to > $totalPage) {
                $from = $currentPage - $totalPage - $to;
                $to = $totalPage;
                if (($to - $from) < $showPageCount && ($to - $from) < $totalPage) {
                    $from = $totalPage - $showPageCount + 1;
                } else {
                    $from = $totalPage - $showPageCount + 1;
                }
            }
        }
        $url = $url . $pageName;
        if ($currentPage > 1) {
            $html .= sprintf('<li><a href="%s">上一页</a></li>', $url . '=' . ($currentPage - 1));
        }
        for ($i = $from; $i <= $to; $i++) {
            if ($i == $currentPage) {
                $html .= sprintf('<li class="active"><a>%d</a></li>', $i);
            } else {
                $html .= sprintf('<li><a href="%s">%d</a></li>', $url . '=' . $i, $i);
            }
        }
        if ($currentPage < $totalPage) {
            $html .= sprintf('<li><a href="%s">下一页</a></li>', $url . '=' . ($currentPage + 1));
        }
        return $html;
    }

    /**
     * 
     * $currentPage 当前页
     * $pageSize    页面大小
     */
    public static function calculateOffset($currentPage, $pageSize) {
        $currentPage = $currentPage < 1 ? 1 : intval($currentPage);
        $offset = ($currentPage - 1) * $pageSize;
        return array($currentPage, $offset);
    }
}