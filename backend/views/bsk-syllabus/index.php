<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\helpers\EnumHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BskSyllabusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Bsk Syllabi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-syllabus-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Syllabus'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'grade',
                'enum' => EnumHelper::grades(),
                'filter' => EnumHelper::grades(),
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'science',
                'enum' => EnumHelper::sciences(),
                'filter' => EnumHelper::sciences(),
            ],
            'name',
            // 'updated_by',
            // 'created_by',
            'updated_at:datetime',
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
