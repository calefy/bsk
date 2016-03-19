<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BskCategoryOther */

$this->title = Yii::t('backend', 'Update').'扩展分类' . ' ' . $model->id;
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = ['label' => '扩展分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="bsk-category-other-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
