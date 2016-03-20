<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use kartik\tree\TreeViewInput;
use common\models\BskCategory;
use common\helpers\EnumHelper;

/* @var $this yii\web\View */
/* @var $model common\models\BskCategoryOther */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="bsk-category-other-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo Html::activeHiddenInput($model, 'type', ['value' => Yii::$app->request->get('tag')]) ?>

    <?php
        $grades = BskCategory::find()->select('id, name')->grades()->asArray()->all();
        $grades = ArrayHelper::map($grades, 'id', 'name');
        echo $form->field($model, 'grade_id')->dropDownList($grades, ['prompt' => '选择...'])
    ?>

    <?php echo $form->field($model, 'semester_id')->widget(TreeViewInput::className(), [
        'query' => BskCategory::find()->semesters(),
        'multiple' => false,     // set to false if you do not need multiple selection
        'options' => [ 'id' => Html::getInputId($model, 'semester_id') ], // 与表单其他项保持一致，以便require验证
    ]) ?>

    <?php
        $sciences = BskCategory::find()->select('id, name')->sciences()->asArray()->all();
        $sciences = ArrayHelper::map($sciences, 'id', 'name');
        echo $form->field($model, 'science_id')->dropDownList($sciences, ['prompt' => '选择...'])
    ?>

    <?php
        $syllabus = BskCategory::find()->select('id, name')->syllabus()->asArray()->all();
        $syllabus = ArrayHelper::map($syllabus, 'id', 'name');
        echo $form->field($model, 'syllabus_id')->dropDownList($syllabus, ['prompt' => '选择...'])
    ?>

    <?php // echo $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
