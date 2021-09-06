<?php
/**
 * 描述：
 * Created at 2021/9/6 9:49 by 陈庙琴
 */

namespace cmq2080\func_kit;


class Url
{
    /**
     * 功能：获取当前地址
     * Created at 2021/9/6 9:06 by Temple Chan
     * @param bool $with_uri 是否全路由（加上uri的部分）
     * @param bool $with_query_string 是否加上查询字符串的部分
     * @return string
     */
    public static function get($with_uri = true, $with_query_string = true)
    {
        return Request::get_url($with_uri, $with_query_string);
    }

    /**
     * 功能：使用js弹出消息并重定向到上一级
     * Created at 2021/9/6 9:49 by 陈庙琴
     * @param $message
     * @param null $redirect_url
     */
    public static function back($message, $redirect_url = null)
    {
        $text = '<script>alert("' . $message . '");';
        switch ($redirect_url) {
            case null:// 没有重定向的url，则返回上一页
                $text .= 'window.history.go(-1);';
                break;
            default:
                $text .= 'location.href="' . $redirect_url . '";';
        }
        $text .= '</script>';
        exit($text);
    }
}