<?php

namespace common\models;

use Yii;

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
            [['id', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'required'],
            [['id', 'grade', 'science', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer'],
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
            'grade' => Yii::t('common', '年级级别：1-小学、2-中学、3-高中'),
            'science' => Yii::t('common', '学科：1-数学'),
            'name' => Yii::t('common', '大纲版本名称'),
            'status' => Yii::t('common', '状态：0-删除，1-有效'),
            'updated_by' => Yii::t('common', '更新者'),
            'created_by' => Yii::t('common', '创建者'),
            'updated_at' => Yii::t('common', '更新时间'),
            'created_at' => Yii::t('common', '创建时间'),
        ];
    }
}
