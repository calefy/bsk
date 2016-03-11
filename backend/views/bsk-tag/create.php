<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskTag */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Tag'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-tag-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
