<?php
/**
 * 描述：
 * Created at 2021/9/6 9:12 by Temple Chan
 */

namespace cmq2080\func_kit;


class String
{
    /**
     * 功能：字符串驼峰转蛇式
     * Created at 2021/9/6 9:16 by Temple Chan
     * @param $string
     * @return string
     */
    public static function c2s($string)
    {
        $glue = '_';
        $array = str_split($string);
        foreach ($array as $key => $value) {
            if (ord($value) >= 65 && ord($value) <= 90) { // 大写字母A-Z
                $array[$key] = $glue . chr(ord($value) + 32);
            }
        }

        return ltrim(implode('', $array), $glue); // 如果是全驼峰的话，最前面一定会有分割符，这时候我们就把它去掉
    }


    /**
     * 功能：判断字符串是否以某字符串为结尾
     * Created at 2021/9/6 9:18 by Temple Chan
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function end_with($haystack, $needle)
    {
        $haystack_length = mb_strlen($haystack);
        $needle_length = mb_strlen($needle);
        if ($haystack_length <= $needle_length) {
            return false;
        }
        $str = mb_substr($haystack, (-1) * $needle_length);
        if ($str === $needle) {
            return true;
        }

        return false;
    }


    /**
     * 功能：字符串限制
     * Created at 2021/9/6 9:20 by Temple Chan
     * @param $string
     * @param $length
     * @param string $sign
     * @return string
     */
    public static function limit($string, $length, $sign = '...')
    {
        if (mb_strlen($string) <= $length) {
            return $string;
        } else {
            $string = mb_substr($string, 0, $length) . $sign;
            return $string;
        }
    }


    /**
     * 功能：去除字符串中重复的子字符串
     * Created at 2021/9/6 9:27 by Temple Chan
     * @param $string
     * @param string $str
     * @return mixed
     */
    public static function tc_str_m21($string, $str = ' ')
    {
        $double_str = $str . $str;
        while (strpos($string, $double_str) !== false) {
            $string = str_replace($double_str, $str, $string);
        }

        return $string;
    }


    /**
     * 功能：生成随机字符串
     * Created at 2021/9/6 9:27 by Temple Chan
     * @param int $length
     * @param bool $only_number
     * @param bool $case_insensitive
     * @return string
     */
    public static function rand($length = 4, $only_number = false, $case_insensitive = false)
    {
        $number_text = '1234567890';
        $lower_text = 'abcdefghijklmnopqrstuvwxyz';
        $upper_text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($only_number === true) {
            $text = $number_text;
        } else if ($case_insensitive === true) {
            $text = $number_text . $lower_text;
        } else {
            $text = $number_text . $lower_text . $upper_text;
        }
        $str = '';
        $chars = str_split($text);// 做成随机字符数组可以比以往的截取字符串提升15-25%的性能（split函数已经废弃）
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $str;
    }


    /**
     * 功能：字符串多路替换
     * Created at 2018/10/1 15:22 by Temple Chan
     * @param $string
     * @param $replace_array
     * @return mixed
     */
    public static function replace($string, $replace_array)
    {
        foreach ($replace_array as $search => $replace) {
            $string = str_replace($search, $replace, $string);
        }
        return $string;
    }


    /**
     * 功能：字符串蛇式转驼峰
     * Created at 2020/5/2 22:25 by mq
     * @param $string
     * @param string $split
     * @param bool $firstWordUpper 第一个词是否也要转为大写，即是否为全驼峰格式
     * @return string
     */
    public static function s2c($string, $split = '_', $firstWordUpper = false)
    {
        $array = explode($split, $string);
        foreach ($array as $key => $value) {
            if ($key === 0 && $firstWordUpper === false) {
                continue;
            }

            $array[$key] = ucfirst($value);
        }

        return implode('', $array);
    }


    /**
     * 功能：字符串切片
     * Created at 2021/9/6 9:35 by Temple Chan
     * @param $string
     * @param $length
     * @param string $sign
     * @return array
     */
    public static function cut($string, $length, $sign = '')
    {
        $str_length = mb_strlen($string);
        $result = [];
        for ($i = 0; $i < $str_length; $i += $length) {
            if ($i + $length > $str_length) { // 截取到头了
                $str = mb_substr($string, $i);
            } else {
                $str = mb_substr($string, $i, $length);
            }

            $result[] = $sign . $str . $sign;
        }
        return $result;
    }


    /**
     * 功能：判断字符串是否以某字符串为开头
     * Created at 2021/9/6 9:46 by Temple Chan
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function start_with($haystack, $needle)
    {
        if (mb_strlen($needle) > 0 && mb_strpos($haystack, $needle) === 0) {
            return true;
        }

        return false;
    }
}