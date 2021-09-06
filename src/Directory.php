<?php
/**
 * 描述：
 * Created at 2021/9/6 10:24 by Temple Chan
 */

namespace cmq2080\func_kit;


class Directory
{
    /**
     * 功能：创建目录
     * Created at 2021/9/6 10:27 by Temple Chan
     * @param $dir
     */
    public static function make($dir)
    {
        if (is_dir($dir) === false) {
            mkdir($dir, 0777, true);
        }
    }

    /**
     * 功能：删除目录
     * Created at 2021/9/6 10:27 by Temple Chan
     * @param $dir
     */
    public static function del($dir)
    {
        foreach (scandir($dir) as $node) {
            if ($node === '.' || $node === '..') {
                continue;
            }
            if (is_dir($dir . '/' . $node) === true) {
                self::del($dir . '/' . $node);
            } else if (is_file($dir . '/' . $node) === true) {
                unlink($dir . '/' . $node);
            }
        }

        rmdir($dir);
    }
}