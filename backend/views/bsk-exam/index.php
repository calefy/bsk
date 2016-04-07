<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BskExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Bsk Exams');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-exam-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Exam'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'type',
            //'category_id',
           // [
           //     'label' => '短标题',
           //     'format' => 'html',
           //     'value' => function($model) {
           //         return $model->short_time . '&middot;' . $model->short_addr;
           //     }
           // ],
            'short_time',
            'short_addr',
            'title',
            //'description',
            // 'stem',
            // 'status',
            // 'updated_by',
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'filter' => false,
            ],
            // 'created_by',
            //'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
