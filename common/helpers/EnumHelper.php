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

    /**
     * 学期列表：1-24分别标识对应级别中的年级上下学期
     */
    public static function semesters() {
        // TODO
        return [
            '1' => '一年级上'
        ];
    }

}
