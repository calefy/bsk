<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\BskCategoryOther;

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
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'grade_id',
                'value' => function($model) use ($categories) {
                    $id = $model->grade_id;
                    return isset($categories[$id]) ? $categories[$id] : $id;
                }
            ],
            [
                'attribute' => 'semester_id',
                'value' => function($model) use ($categories) {
                    $id = $model->semester_id;
                    return isset($categories[$id]) ? $categories[$id] : ($id ? $id : '');
                }
            ],
            [
                'attribute' => 'science_id',
                'value' => function($model) use ($categories) {
                    $id = $model->science_id;
                    return isset($categories[$id]) ? $categories[$id] : $id;
                }
            ],
            [
                'attribute' => 'syllabus_id',
                'value' => function($model) use ($categories) {
                    $id = $model->syllabus_id;
                    return isset($categories[$id]) ? $categories[$id] : ($id ? $id : '');
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function($model) use ($categories) {
                    $id = $model->category_id;
                    return isset($categories[$id]) ? $categories[$id] : $id;
                }
            ],
            [
                'attribute' => 'type',
                'value' => function($model) use ($types) {
                    return $types[$model->type];
                }
            ],
            // 'status',
            // 'updated_at',
            // 'created_at',
            // 'updated_by',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
