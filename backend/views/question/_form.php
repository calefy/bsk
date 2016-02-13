<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use shiyang\umeditor\UMeditor;
use common\models\Question;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\bootstrap\ActiveForm */

$editorConfig = [
    'clientOptions' => [
        'initialFrameHeight' => 120,
        'toolbar' => [
            'bold italic underline strikethrough | forecolor backcolor | removeformat | superscript subscript formula |',
            'emotion image video',
            '| preview '
        ],
    ]
];
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'type')->dropDownList(Question::types()) ?>

    <?php // echo $form->field($model, 'title')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'title')->widget(UMeditor::className(), $editorConfig) ?>

    <?php // echo $form->field($model, 'options')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'options')->widget(UMeditor::className(), $editorConfig) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
