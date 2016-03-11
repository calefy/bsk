<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_exam_question".
 *
 * @property string $id
 * @property string $exam_id
 * @property string $question_id
 * @property integer $status
 * @property string $updated_by
 * @property string $created_by
 * @property integer $updated_at
 * @property integer $created_at
 */
class BskExamQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_exam_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'exam_id', 'question_id', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'required'],
            [['id', 'exam_id', 'question_id', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'exam_id' => Yii::t('app', '试卷ID'),
            'question_id' => Yii::t('app', '问题ID'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
