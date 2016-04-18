<?php
use common\models\BskQuestion;
use yii\helpers\Url;

\common\assets\MathJax::register($this);

$this->title = $model->title;
?>
<div class="exam-view">
    <div class="text-center">
        <h2>(<?=$model->short_time . '&middot;' . $model->short_addr?>)<?=$model->title?></h2>
    </div>
    <div><?=$model->description?></div>

    <hr>

    <div>
        <?php
            $mTitle = ['一', '二', '三'];
            $lastType = null;
            $lastIndex = 0;
        ?>
        <?php foreach($questions as $index=>$question): ?>
            <?php
                if ($lastType !== $question->type) {
                    echo '<h4>' . array_shift($mTitle) . '、' . BskQuestion::types()[$question->type] . '</h4>';
                    $lastType = $question->type;
                    $lastIndex = $index;
                }
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div><?=($index - $lastIndex + 1) . '. ' . BskQuestion::replaceFill($question)?></div>
                    <?php if ($question->type == BskQuestion::QUESTION_TYPE_SELECT): ?>
                    <div style="padding: 15px 20px 0" class="row">
                        <?php $opts = json_decode($question->info, true); ?>
                        <?php foreach($opts as $i => $opt): ?>
                            <?php $correct = isset($opt['correct']) ? $opt['correct'] : false; ?>
                            <p class="col-sm-3 <?php// echo $correct ? 'bg-green' : ''?>"><?=chr(65 + $i)?>. <?=$opt['text']?></p>
                        <?php endforeach;?>
                    </div>
                    <?php endif;?>
                </div>
                <div class="panel-footer clearfix">
                    <a class="pull-right" href="<?=Url::to(['/question/view', 'id' => $question->id])?>" target="_blank">查看详情</a>
                    <span class="pull-right">难度：<?=$question->level / 100?> &emsp; </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
