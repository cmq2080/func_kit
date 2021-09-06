<?php
/**
 * 描述：
 * Created at 2021/9/6 10:32 by 陈庙琴
 */

namespace cmq2080\func_kit;


class Time
{
    /**
     * 功能：获取微秒级时间戳（可能不准）
     * Created at 2021/9/6 10:27 by 陈庙琴
     * @param null $timestamp
     * @return string
     */
    public static function micro($timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }

        return $timestamp . mt_rand(100, 999);
    }
}