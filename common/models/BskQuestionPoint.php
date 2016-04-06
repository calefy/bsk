<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_question_point".
 *
 * @property string $id
 * @property string $question_id
 * @property string $point_id
 * @property integer $status
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $created_by
 * @property integer $created_at
 */
class BskQuestionPoint extends BskBaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_question_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'point_id'], 'required'],
            [['id', 'question_id', 'point_id', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'question_id' => Yii::t('common', '试题ID'),
            'point_id' => Yii::t('common', '考点ID'),
            'status' => Yii::t('common', '状态：0-删除，1-有效'),
            'updated_by' => Yii::t('common', '更新者'),
            'updated_at' => Yii::t('common', '更新时间'),
            'created_by' => Yii::t('common', '创建者'),
            'created_at' => Yii::t('common', '创建时间'),
        ];
    }
}
