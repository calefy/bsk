<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BskAdPosition */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend', 'Bsk Ad Position'),
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Ad Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="bsk-ad-position-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
