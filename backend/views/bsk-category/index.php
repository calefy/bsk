<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\BskCategoryOther;
use common\grid\EnumColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BskCategoryOtherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '扩展分类管理';
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = $this->title;

$types = BskCategoryOther::types();
?>
<div class="bsk-category-other-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            foreach($types as $key => $val) {
                echo Html::a(Yii::t('backend', 'Create') . $val . '分类', ['create', 'tag' => $key ], ['class' => 'btn btn-success']) . '  ';
            }
        ?>
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
                'enum' => $types,
                'filter' => $types,
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'grade_id',
                'enum' => $grades,
                'filter' => $grades,
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'semester_id',
                'enum' => $semesters,
                'filter' => $semesters,
                'value' => function($model) use($semesters) {
                    $id = $model->semester_id;
                    return isset($semesters[$id]) ? $semesters[$id] : '';
                }
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'science_id',
                'enum' => $sciences,
                'filter' => $sciences,
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'syllabus_id',
                'enum' => $syllabus,
                'filter' => $syllabus,
                'value' => function($model) use($syllabus) {
                    $id = $model->syllabus_id;
                    return isset($syllabus[$id]) ? $syllabus[$id] : '';
                }
            ],
            // 'status',
            // 'updated_at',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => false,
            ],
            // 'updated_by',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
