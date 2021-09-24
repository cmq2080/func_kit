<?php
/**
 * 描述：
 * Created at 2021/9/9 10:04 by Temple Chan
 */

namespace cmq2080\func_kit;


class IDCard
{
    /**
     * 功能：获取身份证用户出生日期
     * Created at 2021/9/9 10:17 by Temple Chan
     * @param $id_card_no
     * @param string $format
     * @return false|string
     */
    public static function get_birthday($id_card_no, $format = 'Y-m-d')
    {
        if (!$id_card_no) {
            return '';
        }

        // 提取中间字符串
        $rawStr = substr($id_card_no, 6, 8);
        if (strlen($rawStr) !== 8) {
            return '';
        }

        // 提取年、月、日
        $year = substr($rawStr, 0, 4);
        $month = substr($rawStr, 4, 2);
        $date = substr($rawStr, 6, 2);

        $timestamp = strtotime($year . '-' . $month . '-' . $date);
        return date($format, $timestamp);
    }

    /**
     * 功能：获取身份证用户年龄（可能不准）
     * Created at 2021/9/9 10:17 by Temple Chan
     * @param $id_card_no
     * @return int
     */
    public static function get_age($id_card_no)
    {
        $birthday = self::get_birthday($id_card_no, 'Y-m-d');
        $timestamp = strtotime($birthday . ' 00:00:00');

        return intval((time() - $timestamp) / (86400 * 365.25));
    }

    /**
     * 功能：获取身份证用户性别
     * Created at 2021/9/9 10:23 by Temple Chan
     * @param $id_card_no
     * @return int
     */
    public static function get_sex($id_card_no)
    {
        if (strlen($id_card_no) !== 18) {
            return 0;
        }

        $bit = substr($id_card_no, -2, 1);
        return ($bit % 2 === 0) ? 2 : 1;
    }
}