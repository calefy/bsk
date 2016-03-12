<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskQuestion */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Question'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-question-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
