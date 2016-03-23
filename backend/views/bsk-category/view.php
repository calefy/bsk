<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use kartik\tree\TreeView;
use common\models\BskCategory;
use common\models\BskCategoryOther;

/* @var $this yii\web\View */
/* @var $model common\models\BskCategoryOther */

$this->title = $model->id;
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = ['label' => '扩展分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$types = BskCategoryOther::types();
?>
<div class="bsk-category-other-view">


    <?php // echo DetailView::widget([
        //'model' => $model,
        //'attributes' => [
        //    'id',
        //    [
        //        'attribute' => 'type',
        //        'value' => $types[$model->type],
        //    ],
        //    [
        //        'attribute' => 'grade_id',
        //        'value' => $categories[$model->grade_id],
        //    ],
        //    [
        //        'attribute' => 'semester_id',
        //        'value' => isset($categories[$model->semester_id]) ? $categories[$model->semester_id] : $model->semester_id,
        //    ],
        //    [
        //        'attribute' => 'science_id',
        //        'value' => $categories[$model->science_id],
        //    ],
        //    [
        //        'attribute' => 'syllabus_id',
        //        'value' => isset($categories[$model->syllabus_id]) ? $categories[$model->syllabus_id] : $model->syllabus_id,
        //    ],
        //    'updated_at:datetime',
        //    'created_at:datetime',
        //],
    //]) ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <p class="pull-right">
                <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <div>
                <p><strong><?=$types[$model->type]?>分类</strong></p>
                <p>
                    <?=$categories[$model->grade_id] ?>
                    &gt;
                    <?=isset($categories[$model->semester_id]) ? $categories[$model->semester_id] . ' &gt;' : ''?>
                    <?=$categories[$model->science_id]?>
                    <?=isset($categories[$model->syllabus_id]) ? ' &gt; '.$categories[$model->syllabus_id] : ''?>
                </p>
            </div>
        </div>
    </div>

    <?php
        echo TreeView::widget([
            // single query fetch to render the tree
            // use the Product model you have in the previous step
            'query' => BskCategory::find()->andWhere(['root' => $model->category_id])->addOrderBy('root, lft'),
            'headingOptions'=>['label'=> '分类设置'],
            'iconEditSettings' => [ // 不显示icon的编辑部分
                'show' => 'none',
            ],
            'displayValue' => $model->category_id,
            'allowNewRoots' => false,
        ]);
    ?>

</div>
