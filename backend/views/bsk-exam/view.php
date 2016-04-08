<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\BskQuestion;

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
        <?=Html::a('从题库中添加', ['#'], ['class' => 'btn btn-warning'])?>
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
        <?php foreach($model->questions as $index=>$question): ?>
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
