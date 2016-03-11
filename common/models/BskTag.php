<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "bsk_tag".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $created_by
 * @property integer $created_at
 */
class BskTag extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::statuses())],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', '标签名称'),
            'status' => Yii::t('common', 'Status'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'created_by' => Yii::t('common', 'Created By'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [ \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'id' ],
                'value' => function() {
                    return getUniqueID();
                },
            ]
        ]);
    }

    public static function find() {
        return parent::find()->where([self::tableName() . '.status' => self::STATUS_ACTIVE]);
    }

    public static function statuses()
    {
        return [
            self::STATUS_DELETED => Yii::t('common', 'Deleted'),
            self::STATUS_ACTIVE => Yii::t('common', 'Active'),
        ];
    }
}
