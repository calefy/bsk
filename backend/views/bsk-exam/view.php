<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BskExam */

\common\assets\MathJax::register($this);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Exams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-exam-view">

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

    <div>
        <h3 class="text-center">（<?=$model->short_time . '&middot;' . $model->short_addr?>）<?=$model->title?></h3>
        <p><?=$model->description?></p>
    </div>

    <div>
        <?php foreach($model->questions as $question): ?>
            <div class="box box-solid">
                <div class="box-header"><?=$question->title?></div>
                <div class="box-body">opt.</div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
