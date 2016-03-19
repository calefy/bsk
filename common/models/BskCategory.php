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

    public static function find() {
        return parent::find()->where([self::tableName() . '.active' => self::STATUS_ACTIVE]);
    }
}
