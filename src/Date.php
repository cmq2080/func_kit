<?php
/**
 * 描述：
 * Created at 2021/9/6 9:54 by 陈庙琴
 */

namespace cmq2080\func_kit;


class Date
{
    /**
     * 功能：获取格式化后的时间
     * Created at 2021/9/6 10:30 by 陈庙琴
     * @param string $format
     * @param null $timestamp
     * @return false|string
     */
    public static function get($format = 'Y-m-d H:i:s', $timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }

        return date($format, $timestamp);
    }

    /**
     * 功能：获取汉字状态下的日期
     * Created at 2021/9/6 10:28 by 陈庙琴
     * @param null $timestamp
     * @return string
     */
    public static function get_in_hancase($timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }

        $year = date('Y', $timestamp);
        $month = date('n', $timestamp);
        $day = date('j', $timestamp);

        $str = '';

        $map = [
            "〇", "一", "二", "三", "四", "五", "六", "七", "八", "九", "十",
        ];

        // 转换年
        foreach (str_split($year) as $letter) {
            $str .= $map[$letter];
        }
        $str .= '年';

        // 转换月
        if ($month > 10) {
            $str .= '十';
            $tmp = $month % 10;
            if ($tmp > 0) {
                $str .= $map[$tmp];
            }
        } else {
            $str .= $map[$month];
        }
        $str .= '月';

        // 转换日
        $tmp1 = intval($day / 10);
        $tmp2 = intval($day % 10);
        if ($tmp1 > 1) {
            $str .= $map[$tmp1] . '十';
        } else if ($tmp1 === 1) {
            $str .= '十';
        }

//        // second way
//        if ($tmp1 >= 1) {
//            if ($tmp1 > 1) {
//                $str .= $map[$tmp1];
//            }
//            $str .= '十';
//        }
        $str .= $map[$tmp2];
        $str .= '日';

        return $str;
    }
}