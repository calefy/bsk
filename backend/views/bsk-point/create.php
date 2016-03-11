<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskCategory */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Bsk Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
