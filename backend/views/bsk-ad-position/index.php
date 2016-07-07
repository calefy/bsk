<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BskAdPositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Bsk Ad Positions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-ad-position-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Ad Position'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'key',
            'description',
            [
                'label' => '位置示意图',
                'format' => 'html',
                'value' => function($model) {
                    if (!$model->image_path) return null;
                    return Html::img($model->image_base_url .'/'. $model->image_path, ['class'=> 'mh100 mw300']);
                }
            ],
            //'status',
            //'updated_by',
            // 'updated_at',
            // 'created_by',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
