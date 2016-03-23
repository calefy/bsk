<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use kartik\tree\TreeViewInput;
use common\models\BskCategory;
use common\models\BskCategoryOther;
use common\models\BskQuestion;

/* @var $this yii\web\View */
/* @var $model common\models\BskQuestion */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="bsk-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>


    <?php
        if ($chapterRoots) {
            echo $form->field($model, 'chapter_id')->widget(TreeViewInput::className(), [
                'query' => BskCategory::find()->andWhere(['root' => $chapterRoots])->addOrderBy('root, lft'),
                'multiple' => false,     // set to false if you do not need multiple selection
                'options' => [ 'id' => Html::getInputId($model, 'chapter_id') ], // 与表单其他项保持一致，以便require验证
            ]);
        } else {
    ?>
        <div class="form-group">
            <label class="control-label">章节</label>
            <p>尚未设置章节信息，请先<?= Html::a('新建章节', ['/bsk-category/create', 'tag' => BskCategoryOther::CATEGORY_TYPE_CHAPTER])?></p>
        </div>
    <?php } ?>

    <?php echo $form->field($model, 'type')->dropDownList(BskQuestion::types(), ['prompt' => '选择...']) ?>

    <?php echo $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'level')->textInput() ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
