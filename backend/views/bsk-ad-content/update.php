<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BskAdContent */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('backend','Bsk Ad Content'),
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Ad Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="bsk-ad-content-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
