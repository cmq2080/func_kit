<?php

namespace cmq2080\func_kit;

class Arr
{
    /**
     * 功能：删除数组中有特定值的元素
     * Created at 下午6:35 2018/12/25 By Temple Chan
     * @param $array
     * @param $delete_value
     * @param int $count 最多删除次数，0为无限制
     */
    public static function del(&$array, $delete_value, $count = 0)
    {
        // 初始化计数器（逆向计数，到0停止）（因为0先减为了-1，所以永远也不可能到0）
        $left = $count;
        foreach ($array as $key => $value) {
            if ($value == $delete_value) {
                unset($array[$key]);
                $left--; // 计数器加1
                if ($left === 0) {
                    break;
                }
            }
        }
    }

    /**
     * 功能：按白/黑名单过滤数组
     * 描述：白名单优先于黑名单
     * Created at 16:39 2019-07-18 By Temple Chan
     * @param $array
     * @param array $while_list
     * @param array $black_list
     * @return array
     */
    public static function select($array, $while_list = [], $black_list = [])
    {
        $result = [];
        if (empty($while_list) === false) {
            foreach ($while_list as $key) {
                if (isset($array[$key]) === true) {
                    $result[$key] = $array[$key];
                }
            }
        } else { // 进入黑名单模式
            $result = $array;
            foreach ($black_list as $key) {
                unset($result[$key]);
            }
        }

        return $result;
    }

    /**
     * 功能：去除数组中无意义值的元素（可自定义组合设置）
     * Created at 2018/10/1 10:20 by Temple Chan
     * @param $array
     * @param $filter_list
     * @return mixed
     */
    public static function filter($array, $filter_list = [null, false, '', []])
    {
        if (is_string($filter_list)) {
            $filter_list = [$filter_list];
        }

        foreach ($array as $key => $value) {
            if (in_array($value, $filter_list, true)) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
