<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskCategoryOther */

$this->title = Yii::t('backend', 'Create') . '分类';
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = ['label' => '扩展分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-category-other-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
