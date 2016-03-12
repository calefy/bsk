<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_category".
 *
 * @property string $id
 * @property integer $grade
 * @property integer $science
 * @property integer $semester
 * @property string $syllabus_id
 * @property integer $type
 * @property string $name
 * @property integer $lft
 * @property integer $rgt
 * @property integer $status
 * @property string $updated_by
 * @property string $created_by
 * @property integer $updated_at
 * @property integer $created_at
 */
class BskCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'syllabus_id', 'name', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'required'],
            [['id', 'grade', 'science', 'semester', 'syllabus_id', 'type', 'lft', 'rgt', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer'],
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
            'semester' => Yii::t('common', '学期：1-12分别标识对应级别中的年级上下学期（type=章节时需要）'),
            'syllabus_id' => Yii::t('common', '大纲ID(type=章节时需要)'),
            'type' => Yii::t('common', '分类类型：1-考点，2-章节，3-试卷'),
            'name' => Yii::t('common', '分类名称'),
            'lft' => Yii::t('common', 'Lft'),
            'rgt' => Yii::t('common', 'Rgt'),
            'status' => Yii::t('common', '状态：0-删除，1-有效'),
            'updated_by' => Yii::t('common', '更新者'),
            'created_by' => Yii::t('common', '创建者'),
            'updated_at' => Yii::t('common', '更新时间'),
            'created_at' => Yii::t('common', '创建时间'),
        ];
    }
}
