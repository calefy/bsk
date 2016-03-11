<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_Question".
 *
 * @property string $id
 * @property string $chapter_id
 * @property string $point_id
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
class BskQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_Question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'chapter_id', 'point_id', 'type', 'level', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'required'],
            [['id', 'chapter_id', 'point_id', 'type', 'level', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer'],
            [['title', 'info'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chapter_id' => Yii::t('app', '章节ID'),
            'point_id' => Yii::t('app', '考点ID'),
            'type' => Yii::t('app', '题型：1-选择，2-填空，3-解答'),
            'title' => Yii::t('app', '题干'),
            'info' => Yii::t('app', '选项或答案json'),
            'level' => Yii::t('app', '难度系数'),
            'status' => Yii::t('app', '状态：0-删除，1-有效'),
            'updated_by' => Yii::t('app', '更新者'),
            'updated_at' => Yii::t('app', '更新时间'),
            'created_by' => Yii::t('app', '创建者'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
