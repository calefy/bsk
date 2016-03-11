<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Question2',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="question-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
