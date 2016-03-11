<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BskTag */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend', 'Bsk Tag'),
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="bsk-tag-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
