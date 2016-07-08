<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use kartik\tree\TreeViewInput;
use common\models\BskCategory;
use common\models\BskCategoryOther;

/* @var $this yii\web\View */
/* @var $model common\models\BskExam */
/* @var $form yii\bootstrap\ActiveForm */

\backend\assets\EditorAsset::register($this);
\backend\assets\TreeInputAsset::register($this);

$model->type = $model->type ? $model->type : 1; // 默认写死为真题类型
?>

<div class="bsk-exam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?=Html::hiddenInput(Html::getInputName($model, 'type'), $model->type)?>

    <?=$form->field($model, 'category_id')->widget(TreeViewInput::className(), [
        'query' => BskCategory::find()->andWhere(['root' => $examRoots])->addOrderBy('root, lft'),
        'multiple' => false,
        'options' => [ 'id' => Html::getInputId($model, 'category_id'), 'data-tree-leaf' => true ],
        'rootOptions' => [ 'label' => '全部试卷分类' ],
    ]) ?>

    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'short_time')->textInput(['maxlength' => true, 'placeholder' => '如：2016']) ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'short_addr')->textInput(['maxlength' => true, 'placeholder' => '如：衡中']) ?>
        </div>
    </div>


    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 3, 'data-ckeditor' => true]) ?>

    <?php echo $form->field($model, 'weight')->textInput(['placeholder' => '请输入整数，如 5, 18']) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
