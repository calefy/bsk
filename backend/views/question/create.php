<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Question',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
