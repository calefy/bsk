<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "bsk_ad_position".
 *
 * @property string $id
 * @property string $key
 * @property string $description
 * @property integer $status
 * @property string $updated_by
 * @property integer $updated_at
 * @property string $created_by
 * @property integer $created_at
 */
class BskAdPosition extends BskBaseActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bsk_ad_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer'],
            [['key'], 'string', 'max' => 32],
            [['key'], 'unique'],
            [['image_path'], 'string', 'max' => 128],
            [['image_base_url'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 512],
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
            'key' => Yii::t('common', '广告位标识'),
            'description' => Yii::t('common', '广告位描述'),
            'image_path' => Yii::t('common', '示意图路径'),
            'image_base_url' => Yii::t('common', '示意图路径host'),
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
}
