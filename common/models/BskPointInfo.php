<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_point_info".
 *
 * @property string $id
 * @property string $knowledge
 * @property string $direction
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $created_by
 * @property integer $created_at
 */
class BskPointInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_point_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'knowledge', 'direction', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'required'],
            [['id', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer'],
            [['knowledge', 'direction'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '考点ID'),
            'knowledge' => Yii::t('app', '知识点归纳'),
            'direction' => Yii::t('app', '命题方向'),
            'updated_by' => Yii::t('app', '更新者'),
            'updated_at' => Yii::t('app', '更新时间'),
            'created_by' => Yii::t('app', '创建者'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
