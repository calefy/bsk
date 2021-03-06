<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BskExam */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend', 'Bsk Exam'),
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Exams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="bsk-exam-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'examRoots' => $examRoots,
    ]) ?>

</div>
