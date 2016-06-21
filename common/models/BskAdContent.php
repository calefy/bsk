<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "bsk_ad_content".
 *
 * @property string $id
 * @property string $position_id
 * @property string $image
 * @property string $text1
 * @property string $text2
 * @property string $text3
 * @property integer $status
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $created_by
 * @property integer $created_at
 */
class BskAdContent extends BskBaseActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_ad_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id'], 'required'],
            [['id', 'position_id', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer'],
            [['image_path'], 'string', 'max' => 128],
            [['image_base_url'], 'string', 'max' => 64],
            [['text1', 'text2', 'text3'], 'string', 'max' => 512],
            [['url'], 'string', 'max' => 256],
            ['image', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'position_id' => Yii::t('common', '广告位ID'),
            'image_path' => Yii::t('common', '广告图片路径'),
            'image_base_url' => Yii::t('common', '广告图片host'),
            'text1' => Yii::t('common', '广告文案1'),
            'text2' => Yii::t('common', '广告文案1'),
            'text3' => Yii::t('common', '广告文案1'),
            'url' => Yii::t('common', '跳转地址'),
            'status' => Yii::t('common', 'Status'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'created_by' => Yii::t('common', 'Created By'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'image' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
                'pathAttribute' => 'image_path',
                'baseUrlAttribute' => 'image_base_url'
            ]
        ]);
    }

    public static function find() {
        return parent::find()->where([self::tableName() . '.status' => self::STATUS_ACTIVE]);
    }

    public function getAdPosition() {
        return $this->hasOne(BskAdPosition::className(), ['id' => 'position_id'])
            ->onCondition([BskAdPosition::tableName() . '.status' => BskAdPosition::STATUS_ACTIVE ]);
    }
}
