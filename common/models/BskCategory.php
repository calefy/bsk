<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\helpers\CommonHelper;

/**
 * This is the model class for table "bsk_category".
 * 继承自tree
 */
class BskCategory extends \kartik\tree\models\Tree
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    const CATEGORY_GRADE_ID = '680381940753749';
    const CATEGORY_SCIENCE_ID = '680408093378529';
    const CATEGORY_SYLLABUS_ID = '680415224103023';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_category';
    }


    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [ ActiveRecord::EVENT_BEFORE_INSERT => 'id' ],
                'value' => CommonHelper::getUniqueID(),
            ]
        ]);
    }

    public static function statuses() {
        return [
            self::STATUS_DELETED => Yii::t('common', 'Deleted'),
            self::STATUS_ACTIVE => Yii::t('common', 'Active'),
        ];
    }

    /**
     * 因tree中的 treeQueryClass 设置后无法改变query，因此用find覆盖
     */
    public static function find() {
        return (new \common\models\query\BskCategoryQuery(get_called_class()))
            ->andWhere([ self::tableName().'.active' => self::STATUS_ACTIVE ]);
    }
}
