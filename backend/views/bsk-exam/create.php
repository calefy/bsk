<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskExam */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Exam'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Exams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-exam-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'examRoots' => $examRoots,
    ]) ?>

</div>
