<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BskCategoryOther */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="bsk-category-other-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'grade_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'semester_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'science_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'syllabus_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
