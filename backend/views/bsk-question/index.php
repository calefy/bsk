<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\models\BskQuestion;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BskQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

\common\assets\MathJax::register($this);

$this->title = Yii::t('backend', 'Bsk Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-question-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a class="btn btn-success" href="<?=Url::to(['create', 'type' => BskQuestion::QUESTION_TYPE_SELECT])?>">创建选择题</a>
        <a class="btn btn-success" href="<?=Url::to(['create', 'type' => BskQuestion::QUESTION_TYPE_FILL])?>">创建填空题</a>
        <a class="btn btn-success" href="<?=Url::to(['create', 'type' => BskQuestion::QUESTION_TYPE_ASK])?>">创建问答题</a>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            //'chapter_id',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'type',
                'enum' => BskQuestion::types(),
                'filter' => BskQuestion::types()
            ],
            'title:html',
            // 'info:ntext',
            [
                'attribute' => 'level',
                'value' => function($model) {
                    return $model->level / 100;
                }
            ],
            // 'status',
            // 'updated_by',
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'filter' => false,
            ],
            // 'created_by',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
