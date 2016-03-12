<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BskSyllabus */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend', 'Bsk Syllabus'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Syllabi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-syllabus-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
