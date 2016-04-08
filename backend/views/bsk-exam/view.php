<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\BskQuestion;

use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\BskExam */

\common\assets\MathJax::register($this);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Exams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-exam-view">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        &emsp;&emsp;
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#questionSelect">从题库中添加</button>
        &emsp;&emsp;
        <?=Html::a('新建选择题', ['/bsk-question/create', 'type' => BskQuestion::QUESTION_TYPE_SELECT, 'exam_id' => $model->id], ['class' => 'btn btn-info'])?>
        <?=Html::a('新建填空题', ['/bsk-question/create', 'type' => BskQuestion::QUESTION_TYPE_FILL, 'exam_id' => $model->id], ['class' => 'btn btn-info'])?>
        <?=Html::a('新建问答题', ['/bsk-question/create', 'type' => BskQuestion::QUESTION_TYPE_ASK, 'exam_id' => $model->id], ['class' => 'btn btn-info'])?>
    </p>

    <div>
        <h3 class="text-center">（<?=$model->short_time . '&middot;' . $model->short_addr?>）<?=$model->title?></h3>
        <p><?=$model->description?></p>
    </div>
    <hr>


    <div>
        <?php foreach($questions as $index=>$question): ?>
            <div class="box box-solid question-item">
                <div class="box-header"><?=($index + 1) . '. ' . BskQuestion::replaceFill($question)?></div>
                <?php if ($question->type == BskQuestion::QUESTION_TYPE_SELECT): ?>
                <div class="box-body">
                    <?php $opts = json_decode($question->info, true); ?>
                    <?php foreach($opts as $i => $opt): ?>
                        <?php $correct = isset($opt['correct']) ? $opt['correct'] : false; ?>
                        <p class="<?=$correct ? 'bg-green' : ''?>"><?=chr(65 + $i)?>. <?=$opt['text']?></p>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
                <div class="box-footer clearfix">
                    <a class="pull-right" href="/bsk-question/view?id=<?=$question->id?>" target="_blank">查看详情</a>
                    <span class="pull-right">难度：<?=$question->level / 100?> &emsp; </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="modal fade" id="questionSelect">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">从题库添加</h4>
      </div>
      <form action="<?=\yii\helpers\Url::to(['question-selected'])?>" method="POST">
          <input type="hidden" name="exam_id" value="<?=$model->id?>">
          <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

          <div class="modal-body">
            <?=Select2::widget([
                'name' => 'sels',
                'options' => ['placeholder' => '请选择试题...', 'multiple' => true],
                'pluginOptions' => [
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return '数据加载中...'; }"),
                    ],
                    'ajax' => [
                        'url' => \yii\helpers\Url::to(['question-select', 'exam_id' => $model->id]),
                        'dataType' => 'json',
                        'delay' => 250,
                        'cache' => true,
                        'data' => new JsExpression('function(params) { return {q:params.term, page: params.page}; }'),
                        'processResults' => new JsExpression('function(data, params){ params.page = params.page || 1; return {results: data.list, pagenation: {more: (params.page * 20) < data.total}} }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(item) { return item.title; }'),
                    'templateSelection' => new JsExpression('function (item) { return item.title; }'),
                ],
            ])?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">保存</button>
          </div>
      </form>
    </div>
  </div>
</div>
