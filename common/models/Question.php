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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'title', 'updated_at', 'created_at', 'updated_by', 'created_by'], 'required'],
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
}
