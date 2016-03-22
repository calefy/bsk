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
    const CATEGORY_TYPE_POINT = 1;
    const CATEGORY_TYPE_CHAPTER = 2;
    const CATEGORY_TYPE_EXAM = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_category_other';
    }

    public function scenarios() {
        return [
            'point' => ['grade_id', 'science_id', 'type', 'category_id'],
            'other' => ['grade_id', 'science_id', 'semester_id', 'syllabus_id', 'type', 'category_id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade_id', 'science_id', 'type'], 'required', 'on' => 'point'],
            [['semester_id', 'science_id', 'type', 'syllabus_id'], 'required', 'on' => 'other'],
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
            'grade_id' => Yii::t('common', '年级'),
            'semester_id' => Yii::t('common', '学期'),
            'science_id' => Yii::t('common', '学科'),
            'syllabus_id' => Yii::t('common', '大纲版本'),
            'category_id' => Yii::t('common', '分类'),
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

    public static function types() {
        return [
            self::CATEGORY_TYPE_POINT => '考点',
            self::CATEGORY_TYPE_CHAPTER => '章节',
            self::CATEGORY_TYPE_EXAM => '试卷',
        ];
    }
}
