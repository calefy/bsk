<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\EnumHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BskCategoryOtherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '扩展分类管理';
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-category-other-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            foreach(EnumHelper::categoryTypes() as $key => $val) {
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
            'grade_id',
            'semester_id',
            'science_id',
            'syllabus_id',
            'category_id',
            'type',
            // 'status',
            // 'updated_at',
            // 'created_at',
            // 'updated_by',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
