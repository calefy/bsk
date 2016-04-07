<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BskQuestion */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend', 'Bsk Question'),
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="bsk-question-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'chapterRoots' => $chapterRoots,
        'pointRoots' => $pointRoots,
    ]) ?>

</div>
