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
        <div class="box-body" id="questionBody">

            <div class="well well-sm">
                <p>* 直接点击内容进行编辑</p>
                <?php if ($model->type == BskQuestion::QUESTION_TYPE_SELECT): ?>
                <p>* 选项前面的选择框，表示该项是否是正确答案</p>
                <?php endif; ?>
                <?php if ($model->type == BskQuestion::QUESTION_TYPE_FILL): ?>
                <p>* 请用三个下划线"___"表示填空位置</p>
                <?php endif; ?>
            </div>

            <?php echo Html::hiddenInput(Html::getInputName($model, 'title'), $model->title, ['id' => Html::getInputId($model, 'title')]) ?>
            <?php echo Html::hiddenInput(Html::getInputName($model, 'info'), $model->info, ['id' => Html::getInputId($model, 'info')]) ?>

            <div class="form-group question-edit">
                <dl data-role="options">
                    <dt><div contenteditable="true" id="title">点击这里编辑题干</div></dt>
                </dl>
                <?php if ($model->type != BskQuestion::QUESTION_TYPE_ASK): ?>
                <p class="btns"><button type="button" data-role="addOption" class="btn btn-info btn-xs">添加<?=$model->type == BskQuestion::QUESTION_TYPE_FILL ? '填空答案' : '选项'?></button></p>
                <?php endif; ?>
            </div>

            <br>



        </div>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton(!$model->id ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => !$model->id ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
<?php $this->endBlock(); ?>

<?php
// 输出一些配置变量到页面中
$titleId = Html::getInputId($model, 'title');
$infoId = Html::getInputId($model, 'info');
$mathjaxLib = \common\assets\MathJax::CDN;

$conf = <<<CONF
var bsk_question = {
    type: $model->type,
    infoId: '{$infoId}',
    titleId: '{$titleId}',
    treeInputIds: ['{$chapterTreeInputId}', '{$pointTreeInputId}'],
    mathjaxLib: '{$mathjaxLib}'
};
CONF;
$this->registerJs($conf, $this::POS_END);
?>
