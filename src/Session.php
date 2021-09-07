<?php
/**
 * 描述：
 * Created at 2021/9/6 9:02 by Temple Chan
 */

namespace cmq2080\func_kit;


class Session
{
    /**
     * 功能：如果session没启用，则启用session
     * Created at 2021/9/6 9:02 by Temple Chan
     */
    public static function start()
    {
        if (isset($_SESSION) === false) {
            session_start();
        }
    }
}