<?php
namespace DreamHeaven\Common\Helper;

/**
 * 创建这个类的原因是因为 PHP 的一些内置的数组处理函数效率太慢了（可能是由于出于通用性考虑的缘故）
 *
 * 测试数据(1000000条随机数据(取值区间：0-999999))：
 * diff:            native=14.1955s, helper=0.6445s
 * merge:           native=0.3805s,  helper=0.1991s
 * unique+merge: 	native=9.9425s,  helper=0.7863s
 * unique:          native=8.0977s,  helper=0.5969s
 * intersect:       native=9.5279s,  helper=0.5190s
 * @author LiANG ZHENJiNG liangzhenjing@gmail.com
 */
class ArrayHelper
{
    /**
     * 获取两个数组去重后的差集
     *
     * 注意：
     *  1. 如果数组中的元素是“数字”类型的字符串，会被转换为 int 类型，所以可能会需要自己再转换一次类型
     *  2. 返回的数据已经做去重处理，所以和 array_diff() 的结果可能会不一致
     *
     * 性能测试：
     *  src  = 1000,000 random elements,
     *  diff = 100,000 random elements:
     *  array_diff(array_unique($src), $diff):  8.9s
     *  ArrayHelper::uniqueDiff:                0.6s
     *
     * @param array $src
     * @param array $diff
     * @param bool $diffByKey
     * @return array    返回 $src 减去 $diff，并再做去重后的结果（注意，这个结果和 array_diff() 的结果是不一样的，因为 array_diff 的结果没有做去重）
     */
    public static function diff(array $src, array $diff, $diffByKey = false)
    {
        if ($diffByKey)
        {
            foreach($diff as $value)
            {
                unset($src[$value]);
            }

            return $src;
        }
        else
        {
            $flipped = array_flip($src);
            foreach($diff as $value)
            {
                unset($flipped[$value]);
            }

            return array_flip($flipped);
        }
    }

    /**
     * 合并两个数组，并做去重处理
     *
     * 注意：
     *  1. 如果数组中的元素是“数字”类型的字符串，会被转换为 int 类型，所以可能会需要自己再转换一次类型
     *  2. 返回的数据已经做去重处理，所以和 array_merge() 的结果可能会不一致
     *
     * 性能测试：
     * src  = 1000,000 random elements,
     * diff = 100,000 random elements:
     * array_merge:         0.35s
     * ArrayHelper::merge:  0.21s
     *
     * @param array $src
     * @param array $merge
     * @param type $mergeByKey
     * @return array 返回两个数组的去重后的并集
     */
    public static function merge(array $src, array $merge, $mergeByKey = false)
    {
        if ($mergeByKey)
        {
            foreach($merge as $key => $value)
            {
                $src[$key] = $value;
            }

            return $src;
        }
        else
        {
            $flipped = array_flip($src);
            foreach($merge as $value)
            {
                $flipped[$value] = 1;
            }

            return array_keys($flipped);
        }
    }


    /**
     * 对一个数组做去重处理。
     *
     * 注意：
     *  如果数组中的元素是“数字”类型的字符串，会被转换为 int 类型，所以可能会需要自己再转换一次类型
     *
     * src  = 1000,000 random elements,
     * diff = 100,000 random elements:
     * array_unique:        ~= 8s
     * ArrayHelper::unique: ~= 0.6s
     *
     * @param type $src
     * @return type 去重处理后的数组
     */
    public static function unique($src)
    {
        return array_keys(array_flip($src));
    }

    /**
     * 获取两个数组的交集
     *
     * 注意：
     *  1. 如果数组中的元素是“数字”类型的字符串，会被转换为 int 类型，所以可能会需要自己再转换一次类型
     *  2. 返回的数据已经做去重处理，所以和 array_diff() 的结果可能会不一致
     *
     * @param array $array1
     * @param array $array2
     * @return array 返回两个输入数组的交集
     */
    public static function intersect(array $array1, array $array2)
    {
        $array1 = array_flip($array1);
        $array2 = array_flip($array2);
        $result = array_keys(array_intersect_key($array1, $array2));

        return $result;
    }

}

