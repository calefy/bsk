<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use common\models\BskAdPosition;

/* @var $this yii\web\View */
/* @var $model common\models\BskAdContent */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="bsk-ad-content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

     <?php echo $form->field($model, 'position_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(
                    BskAdPosition::find()->select('id, description')->orderBy(['created_at'=>SORT_DESC])->all(),
                    'id',
                    'description'),
            'options' => ['placeholder' => '请选择广告位'],
        ]); ?>

    <?php echo $form->field($model, 'image')->widget(\trntv\filekit\widget\Upload::classname(), [
        'url'=>['ad-image-upload']
    ]) ?>

    <?php echo $form->field($model, 'text1')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'text2')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'text3')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder'=>'如: /exam/view?id=xxx 或 http://....']) ?>

    <?php echo $form->field($model, 'weight')->dropDownList(range(0, 30), ['placeholder' => '优先展示权重值大的广告内容']) ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
