<?php
/**
 * bsk相关model通用ActiveRecord
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\helpers\CommonHelper;


class BskBaseActiveRecord extends ActiveRecord {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName() {
        throw new \yii\base\ErrorException('Need to define tableName');
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
}

