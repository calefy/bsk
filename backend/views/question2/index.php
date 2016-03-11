<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\models\Question2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// 公式asset
\common\assets\MathQuill::register($this);

$this->title = Yii::t('backend', 'Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Question2',
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
                'attribute' => 'type',
                'enum' => Question2::types(),
                'filter' => Question2::types()
            ],
            'title:html',
            'options:html',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => Question2::statuses(),
                'filter' => Question2::statuses()
            ],
            // 'updated_at',
            // 'created_at',
            // 'updated_by',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
