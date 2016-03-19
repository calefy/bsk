<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bsk_category_other".
 *
 * @property string $id
 * @property string $grade_id
 * @property string $semester_id
 * @property string $science_id
 * @property string $syllabus_id
 * @property string $category_id
 * @property integer $type
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 * @property string $updated_by
 * @property string $created_by
 */
class BskCategoryOther extends BskBaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_category_other';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade_id', 'semester_id', 'science_id', 'syllabus_id', 'category_id', 'type', 'status', 'updated_at', 'created_at', 'updated_by', 'created_by'], 'required'],
            [['id', 'grade_id', 'semester_id', 'science_id', 'syllabus_id', 'category_id', 'type', 'status', 'updated_at', 'created_at', 'updated_by', 'created_by'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'grade_id' => Yii::t('common', '年级ID'),
            'semester_id' => Yii::t('common', '学期ID'),
            'science_id' => Yii::t('common', '学科ID'),
            'syllabus_id' => Yii::t('common', '大纲版本ID'),
            'category_id' => Yii::t('common', '实际分类ID'),
            'type' => Yii::t('common', '类型'),
            'status' => Yii::t('common', '状态'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'created_by' => Yii::t('common', 'Created By'),
        ];
    }

    public static function find() {
        return parent::find()->where([self::tableName() . '.status' => self::STATUS_ACTIVE]);
    }
}
