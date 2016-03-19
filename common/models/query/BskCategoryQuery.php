<?php
/**
 * @author calefy <clfsw0201@gmail.com>
 */

namespace common\models\query;

use kartik\tree\models\TreeQuery;
use common\models\BskCategory;

class BskCategoryQuery extends TreeQuery
{
    // 基本分类
    public function based() {
        $this->andWhere(['root' => [
            BskCategory::CATEGORY_GRADE_ID,
            BskCategory::CATEGORY_SCIENCE_ID,
            BskCategory::CATEGORY_SYLLABUS_ID,
        ]]);
        $this->addOrderBy('root, lft');
        return $this;
    }
}

