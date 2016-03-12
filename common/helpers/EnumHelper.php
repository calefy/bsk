<?php
/**
 * 定义枚举常量定义
 */
namespace common\helpers;

class EnumHelper {

    /**
     * 年级级别列表
     */
    public static function grades() {
        return [
            '1' => '小学',
            '2' => '初中',
            '3' => '高中',
        ];
    }
    /**
     * 学科列表
     */
    public static function sciences() {
        return [
            '1' => '数学',
        ];
    }


}
