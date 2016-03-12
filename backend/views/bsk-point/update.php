<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BskCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Bsk Category',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="bsk-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
