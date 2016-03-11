<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_question".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $options
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $created_by
 */
class Question extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE  = 1;

    const TYPE_SINGLE = 1; // 单选题
    const TYPE_MULTER = 2; // 多选题
    const TYPE_FILL   = 3; // 填空题
    const TYPE_ESSAY  = 4; // 问答题

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_question_old';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'title'], 'required'],
            [['type', 'status', 'updated_at', 'created_at', 'updated_by', 'created_by'], 'integer'],
            [['title', 'options'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'type' => Yii::t('backend', '题目类型'), //：1-单选，2-多选，3-填空，4-问答
            'title' => Yii::t('backend', '题干'),
            'options' => Yii::t('backend', '选项'),
            'status' => Yii::t('backend', '状态'), //：0-删除，1-正常
            'updated_at' => Yii::t('backend', '更新时间'),
            'created_at' => Yii::t('backend', '创建时间'),
            'updated_by' => Yii::t('backend', '更新者'),
            'created_by' => Yii::t('backend', '创建者'),
        ];
    }

    public function behaviors() {
        return [
            \yii\behaviors\BlameableBehavior::className(),
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * 题目类型列表
     */
    public static function types() {
        return [
            self::TYPE_SINGLE => Yii::t('backend', '单选题'),
            self::TYPE_MULTER => Yii::t('backend', '多选题'),
            self::TYPE_FILL => Yii::t('backend', '填空题'),
            self::TYPE_ESSAY => Yii::t('backend', '问答题'),
        ];
    }

    /**
     * 题目状态列表
     */
    public static function statuses()
    {
        return [
            self::STATUS_DELETED => Yii::t('common', 'Disabled'),
            self::STATUS_ACTIVE => Yii::t('common', 'Enabled'),
        ];
    }
    public function getCreator() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getUpdator() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
