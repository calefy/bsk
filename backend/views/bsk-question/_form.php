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

\common\assets\CKEditor::register($this);

$chapterTreeInputId = Html::getInputId($model, 'chapter_id');
$pointTreeInputId = 'points';

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

    <div class="col-md-6">
        <?php echo $form->field($model, 'type')->dropDownList(BskQuestion::types(), ['prompt' => '选择...', 'disabled' => true]) ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'level')->textInput() ?>
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

    <div class="form-group col-md-6">
        <label class="control-label">考点</label>
        <?=TreeViewInput::widget([
            'name' => 'points',
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
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->endBlock(); ?>

<?php
$titleId = Html::getInputId($model, 'title');
$mathjaxLib = \common\assets\MathJax::CDN;
$func = <<<FUNC
// 修改选择实现
$('#{$chapterTreeInputId}, #{$pointTreeInputId}')
    .off('treeview.change')
    .on('treeview.change', function(e, key, desc) {
        var input = \$(e.currentTarget),
            d = input.data('treeinput'),
            vkey = [], vdesc = [], keys;
        if (key) {
            keys = ('' + key).split(',');
            keys.forEach(function(item) {
                var li = d.\$tree.find('li[data-key=' + item +']');
                if (li.data('lft') > 1 && li.data('rgt') - li.data('lft') === 1) {
                    vkey.push(item);
                    vdesc.push(li.find('>.kv-tree-list .kv-node-label').text());
                }
            });
        }

        if (!d.treeview.multiple && d.autoCloseOnSelect) {
            d.\$input.closest('.kv-tree-dropdown-container').removeClass('open');
        }
        input.val(vkey.join(''));
        d.setInput(vdesc);
    });

var editorConfig = {
    title: false,
    height: 100,
    uiColor: '#eeeeee',
    resize_enabled: false,
    enterMode: CKEDITOR.ENTER_BR,
    removeButtons: '',
    toolbar: [
        ['Undo', 'Redo'],
        ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'],
        ['Image', 'SpecialChar', 'Mathjax'],
        ['Maximize']
    ],
    filebrowserImageUploadUrl: '',
    mathJaxLib: '{$mathjaxLib}',
    extraPlugins: 'mathjax'
};

CKEDITOR.replace('{$titleId}', editorConfig);
FUNC;
$this->registerJs($func);
?>
