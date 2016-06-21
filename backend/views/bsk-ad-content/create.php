<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskAdContent */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend','Bsk Ad Content'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Ad Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-ad-content-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
