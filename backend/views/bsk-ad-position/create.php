<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskAdPosition */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Bsk Ad Position',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Ad Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-ad-position-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
