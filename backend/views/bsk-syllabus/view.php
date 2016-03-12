<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\EnumHelper;

/* @var $this yii\web\View */
/* @var $model common\models\BskSyllabus */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Syllabi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-syllabus-view">

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
            [
                'attribute' => 'grade',
                'value' => EnumHelper::grades()[$model->grade],
            ],
            [
                'attribute' => 'science',
                'value' => EnumHelper::sciences()[$model->science],
            ],
            'name',
            'updated_at:datetime',
            'created_at:datetime',
        ],
    ]) ?>

</div>
