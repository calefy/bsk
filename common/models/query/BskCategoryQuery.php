<?php
/**
 * @author calefy <clfsw0201@gmail.com>
 */

namespace common\models\query;

use kartik\tree\models\TreeQuery;
use common\models\BskCategory;

class BskCategoryQuery extends TreeQuery
{
    /**
     * 基本分类
     */
    public function based() {
        $this->andWhere(['root' => [
            BskCategory::CATEGORY_GRADE_ID,
            BskCategory::CATEGORY_SCIENCE_ID,
            BskCategory::CATEGORY_SYLLABUS_ID,
        ]]);
        $this->addOrderBy('root, lft');
        return $this;
    }

    /**
     * 年级分类
     */
    public function grades() {
        $this->andWhere([ 'root' => BskCategory::CATEGORY_GRADE_ID ]);
        $this->andWhere([ 'lvl' => 1 ]);
        $this->addOrderBy('root, lft');
        return $this;
    }
    /**
     * 学期分类
     */
    public function semesters() {
        $this->andWhere([ 'root' => BskCategory::CATEGORY_GRADE_ID ]);
        $this->andWhere([ '>', 'lvl', 0 ]);
        $this->addOrderBy('root, lft');
        return $this;
    }
    /**
     * 学科分类
     */
    public function sciences() {
        $this->andWhere([ 'root' => BskCategory::CATEGORY_SCIENCE_ID]);
        $this->andWhere([ 'lvl' => 1 ]);
        $this->addOrderBy('root, lft');
        return $this;
    }
    /**
     * 大纲版本分类
     */
    public function syllabus() {
        $this->andWhere([ 'root' => BskCategory::CATEGORY_SYLLABUS_ID]);
        $this->andWhere([ 'lvl' => 1 ]);
        $this->addOrderBy('root, lft');
        return $this;
    }
}

