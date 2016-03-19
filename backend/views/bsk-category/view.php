<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BskCategoryOther */

$this->title = $model->id;
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = ['label' => '扩展分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-category-other-view">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'grade_id',
            'semester_id',
            'science_id',
            'syllabus_id',
            'category_id',
            'type',
            'status',
            'updated_at',
            'created_at',
            'updated_by',
            'created_by',
        ],
    ]) ?>

</div>
