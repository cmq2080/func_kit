<?php
/**
 * 描述：
 * Created at 2021/9/6 9:03 by Temple Chan
 */

namespace cmq2080\func_kit;


class Request
{
    /**
     * 功能：获取IP地址
     * 注：代码节选自ThinkPHP5
     * Created at 2018/10/1 9:59 by Temple Chan
     * @return string
     */
    public static function get_ip()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }
            $ip = trim(current($arr));
        } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * 功能：获取当前地址
     * Created at 2021/9/6 9:06 by Temple Chan
     * @param bool $with_uri 是否全路由（加上uri的部分）
     * @param bool $with_query_string 是否加上查询字符串的部分
     * @return string
     */
    public static function get_url($with_uri = true, $with_query_string = true)
    {
        // 获取访问协议
        $protocol = 'http://';
        if (isset($_SERVER['HTTPS']) === true && strtolower($_SERVER['HTTPS']) === 'on') {
            $protocol = 'https://';
        }

        // 拼接基本url
        $url = $protocol . $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {// 特殊端口，加端口号
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }

        if ($with_uri) {
            // 拼接全url
            $uri = $_SERVER['REQUEST_URI'];
            if ($with_query_string !== true) {
                $uri = substr($uri, 0, strpos($uri, '?'));
            }
            $url .= $uri;
        }

        return $url;
    }

    /**
     * 功能：判断请求是否来自于移动端
     * Created at 2021/9/6 9:08 by Temple Chan
     * @return bool
     * @throws \Exception
     */
    public static function is_mobile()
    {
        if (isset($_SERVER) === false) {
            throw new \Exception('Unavailable in CLI mode');
        }
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }
        if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false)) {
            $mobile_browser++;
        }
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            $mobile_browser++;
        }
        if (isset($_SERVER['HTTP_PROFILE'])) {
            $mobile_browser++;
        }
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc',
            'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d',
            'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki',
            'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-',
            'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw',
            'xda', 'xda-'
        );
        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false) {
            $mobile_browser++;
        }
        // Pre-final check to reset everything if the user is on Windows
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false) {
            $mobile_browser = 0;
        }
        // But WP7 is also Windows, with a slightly different characteristic
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false) {
            $mobile_browser++;
        }

        return $mobile_browser > 0;
    }

    /**
     * 功能：判断请求是否来自于微信
     * Created at 2021/9/6 9:11 by Temple Chan
     * @return bool
     * @throws \Exception
     */
    function is_weixin()
    {
        if (isset($_SERVER) === false) {
            throw new \Exception('Unavailable in CLI mode');
        }
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }
}