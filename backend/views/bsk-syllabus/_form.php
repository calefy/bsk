<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\EnumHelper;

/* @var $this yii\web\View */
/* @var $model common\models\BskSyllabus */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="bsk-syllabus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'grade')->dropDownList(EnumHelper::grades()) ?>

    <?php echo $form->field($model, 'science')->dropDownList(EnumHelper::sciences()) ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
