<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_question".
 *
 * @property string $id
 * @property string $chapter_id
 * @property integer $type
 * @property string $title
 * @property string $info
 * @property integer $level
 * @property integer $status
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $created_by
 * @property integer $created_at
 */
class BskQuestion extends BskBaseActiveRecord
{
    const QUESTION_TYPE_SELECT = 1;
    const QUESTION_TYPE_FILL = 2;
    const QUESTION_TYPE_ASK = 3;
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
            [['title'], 'required'],
            [['id', 'origin_exam_id', 'chapter_id', 'type', 'level', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::statuses())],
            [['title', 'info', 'analyze', 'answer', 'comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'origin_exam_id' => Yii::t('common', '来源试卷'),
            'chapter_id' => Yii::t('common', '章节'),
            'type' => Yii::t('common', '题型'),
            'title' => Yii::t('common', '题干'),
            'info' => Yii::t('common', '选项或答案'),
            'level' => Yii::t('common', '难度系数'),
            'analyze' => Yii::t('common', '分析'),
            'answer' => Yii::t('common', '解答'),
            'comment' => Yii::t('common', '点评'),
            'status' => Yii::t('common', '状态'),
            'updated_by' => Yii::t('common', '更新者'),
            'updated_at' => Yii::t('common', '更新时间'),
            'created_by' => Yii::t('common', '创建者'),
            'created_at' => Yii::t('common', '创建时间'),
        ];
    }

    public static function find() {
        return parent::find()->where([self::tableName() . '.status' => self::STATUS_ACTIVE]);
    }

    /**
     * 试题类型
     */
    public static function types() {
        return [
            self::QUESTION_TYPE_SELECT => '选择题',
            self::QUESTION_TYPE_FILL => '填空题',
            self::QUESTION_TYPE_ASK => '问答题',
        ];
    }
}
