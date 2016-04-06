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

\backend\assets\QuestionAsset::register($this);

$chapterTreeInputId = Html::getInputId($model, 'chapter_id');
$pointTreeInputId = 'point_ids';

$model->type = $model->type ? $model->type : Yii::$app->request->get('type');
?>

<?php $this->beginBlock('content'); ?>
<div class="bsk-question-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">基本属性</h3>
        </div>
        <div class="box-body row">

            <div class="col-md-6 form-group">
                <label class="control-label"><?=$model->getAttributeLabel('type')?></label>
                <?=Html::textInput(null, BskQuestion::types()[$model->type], [ 'readonly' => true, 'class' => 'form-control' ])?>
                <?=Html::hiddenInput(Html::getInputName($model, 'type'), $model->type) ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model, 'difficult')->hint('请输入0~1之间的数值')->textInput() ?>
            </div>


            <div class="col-md-6">
                <?php if ($chapterRoots):
                    echo $form->field($model, 'chapter_id')->widget(TreeViewInput::className(), [
                        'query' => BskCategory::find()->andWhere(['root' => $chapterRoots])->addOrderBy('root, lft'),
                        'multiple' => false,     // set to false if you do not need multiple selection
                        'options' => [ 'id' => $chapterTreeInputId ], // 与表单其他项保持一致，以便require验证
                        'rootOptions' => [ 'label' => '全部章节定义' ],
                    ]);
                else : ?>
                    <div class="form-group">
                        <label class="control-label">章节</label>
                        <p>尚未设置章节信息，请先<?= Html::a('新建章节', ['/bsk-category/create', 'tag' => BskCategoryOther::CATEGORY_TYPE_CHAPTER])?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <?=$form->field($model, 'point_ids')->widget(TreeViewInput::className(), [
                    'query' => BskCategory::find()->andWhere(['root' => $pointRoots])->addOrderBy('root, lft'),
                    'multiple' => true,
                    'options' => [ 'id' => $pointTreeInputId ],
                    'rootOptions' => [ 'label' => '全部考点定义' ],
                ]) ?>
            </div>

        </div>
    </div>


    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">试题主体</h3>
        </div>
        <div class="box-body">

    <?php echo $form->field($model, 'title')->textarea([ 'rows' => 6 ]) ?>

    <?php echo $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton(!$model->id ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => !$model->id ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->endBlock(); ?>

<?php
$titleId = Html::getInputId($model, 'title');
$mathjaxLib = \common\assets\MathJax::CDN;

$conf = <<<CONF
var bsk_question = {
    treeInputIds: ['{$chapterTreeInputId}', '{$pointTreeInputId}'],
    editorIds: ['{$titleId}'],
    mathjaxLib: '{$mathjaxLib}'
};
CONF;
$this->registerJs($conf, $this::POS_END);
?>
