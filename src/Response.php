<?php

namespace cmq2080\func_kit;

class Response
{
    /**
     * 功能：在ajax请求中返回固定格式的json数据
     * Created at 2019/3/24 14:50 by Temple Chan
     * @param int $stat
     * @param string $msg
     * @param array $data
     * @param bool $return_json
     * @return false|string
     */
    public static function ajax($stat = 0, $msg = 'ok', $data = null, $return_json = false)
    {
        $info = [
            'stat' => $stat,
            'msg'  => $msg
        ];
        if ($data !== null) {
            $info['data'] = $data;
        }
        $info = json_encode($info, JSON_UNESCAPED_UNICODE);

        if ($return_json) {
            return $info;
        } else {
            exit($info);
        }
    }
}
