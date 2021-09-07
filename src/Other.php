<?php
namespace cmq2080\func_kit;

class Other
{
    /**
     * 功能：获取目标类的最终类名
     * Created at 2021/9/6 9:53 by Temple Chan
     * @param $obj
     * @return mixed
     */
    function get_class_name($obj)
    {
        $class_names = explode('\\', get_class($obj));
        $class_name = $class_names[count($class_names) - 1];
        return $class_name;
    }
}