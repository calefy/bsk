<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\helpers\CommonHelper;
use common\helpers\EnumHelper;

/**
 * This is the model class for table "bsk_syllabus".
 *
 * @property string $id
 * @property integer $grade
 * @property integer $science
 * @property string $name
 * @property integer $status
 * @property string $updated_by
 * @property string $created_by
 * @property integer $updated_at
 * @property integer $created_at
 */
class BskSyllabus extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_syllabus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'grade', 'science', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::statuses())],
            ['grade', 'in', 'range' => array_keys(EnumHelper::grades())],
            ['science', 'in', 'range' => array_keys(EnumHelper::sciences())],
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
            'grade' => Yii::t('common', '年级级别'),
            'science' => Yii::t('common', '学科'),
            'name' => Yii::t('common', '大纲名称'),
            'status' => Yii::t('common', '状态'),
            'updated_by' => Yii::t('common', '更新者'),
            'created_by' => Yii::t('common', '创建者'),
            'updated_at' => Yii::t('common', '更新时间'),
            'created_at' => Yii::t('common', '创建时间'),
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
                    return CommonHelper::getUniqueID();
                },
            ]
        ]);
    }

    public static function find() {
        return parent::find()->where([self::tableName() . '.status' => self::STATUS_ACTIVE]);
    }

    public static function statuses() {
        return [
            self::STATUS_DELETED => Yii::t('common', 'Deleted'),
            self::STATUS_ACTIVE => Yii::t('common', 'Active'),
        ];
    }
}
