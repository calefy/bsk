<?php
/**
 * 定义枚举常量定义
 */
namespace common\helpers;

use common\models\BskCategoryOther;

class EnumHelper {

    public static function categoryTypes() {
        return [
            BskCategoryOther::CATEGORY_TYPE_POINT => '考点',
            BskCategoryOther::CATEGORY_TYPE_CHAPTER => '章节',
            BskCategoryOther::CATEGORY_TYPE_EXAM => '试卷',
        ];
    }

}
