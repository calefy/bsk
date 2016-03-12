<?php
/**
 * 定义通用函数
 */
namespace common\helpers;

class CommonHelper {

    /**
     * 生成数据库ID值: 8-10位时间戳（与2016-01-01差值）+6位微秒数+2位随机数
     *
     * @return string
     */
    public static function getUniqueID() {
        $t = microtime(true) - strtotime('2016-01-01');
        $t = explode('.', strval($t * 1000000));
        $t = $t[0] . rand(10, 99);
        return $t;
    }

}
