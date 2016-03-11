<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_tag_any".
 *
 * @property string $id
 * @property integer $target_type
 * @property string $target_id
 * @property string $tag_id
 * @property integer $status
 * @property string $updated_by
 * @property string $created_by
 * @property integer $updated_at
 * @property integer $created_at
 */
class BskTagAny extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_tag_any';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'target_type', 'target_id', 'tag_id', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'required'],
            [['id', 'target_type', 'target_id', 'tag_id', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'target_type' => Yii::t('app', '目标类型：1-试题'),
            'target_id' => Yii::t('app', '目标ID'),
            'tag_id' => Yii::t('app', '标签ID'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
