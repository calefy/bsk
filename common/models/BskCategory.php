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
            [['id', 'syllabus_id', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'required'],
            [['id', 'grade', 'science', 'semester', 'syllabus_id', 'type', 'lft', 'rgt', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'grade' => Yii::t('app', '年级级别：1-小学、2-中学、3-高中'),
            'science' => Yii::t('app', '学科：1-数学'),
            'semester' => Yii::t('app', '学期：1-12分别标识对应级别中的年级上下学期（type=章节时需要）'),
            'syllabus_id' => Yii::t('app', '大纲ID(type=章节时需要)'),
            'type' => Yii::t('app', '分类类型：1-考点，2-章节，3-试卷'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'status' => Yii::t('app', '状态：0-删除，1-有效'),
            'updated_by' => Yii::t('app', '更新者'),
            'created_by' => Yii::t('app', '创建者'),
            'updated_at' => Yii::t('app', '更新时间'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
