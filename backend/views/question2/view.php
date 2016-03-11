<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Question2;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

// 公式asset
\common\assets\MathQuill::register($this);

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view">

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
                'attribute' => 'type',
                'value' => Question2::types()[$model->type]
            ],
            'title:html',
            'options:html',
            'status',
            'updated_at:datetime',
            'created_at:datetime',
            'updator.username:text:更新者',
            'creator.username:text:创建者',
        ],
    ]) ?>

</div>
