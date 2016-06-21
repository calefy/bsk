<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\models\BskAdPosition;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BskAdContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Bsk Ad Contents');
$this->params['breadcrumbs'][] = $this->title;

$allPositions = ArrayHelper::map(BskAdPosition::find()->select('id, description')->all(), 'id', 'description');
?>
<div class="bsk-ad-content-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Ad Content'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'position_id',
                'label' => '广告位',
                'value' => function($model) {
                    return $model->adPosition->description;
                },
                'enum' => $allPositions,
                'filter' => $allPositions,
            ],
            [
                'label' => '广告图片',
                'format' => 'html',
                'value' => function($model) {
                    if (!$model->image_path) return null;
                    return Html::img($model->image_base_url .'/'. $model->image_path, ['class'=> 'mh100 mw300']);
                }
            ],
            'text1',
            'text2',
            'text3',
            'url',
            'weight',
            // 'status',
            // 'updated_by',
            // 'updated_at',
            // 'created_by',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
