<?php
use common\models\BskQuestion;
use yii\helpers\Url;

$types = BskQuestion::types();
$items = json_decode($model->info, true);

$this->title = '试题详情';
?>
<div class="question-view">
    <div class="panel panel-default">
        <div class="panel-heading">试题详情</div>
        <div class="panel-body">
            <div>（<?=$types[$model->type]?>）<?=BskQuestion::replaceFill($model)?></div>
            <?php if ($model->type == BskQuestion::QUESTION_TYPE_SELECT): ?>
                <?php foreach($items as $index=>$item): ?>
                    <p style="padding:5px 20px;margin:0" class="<?=(isset($item['correct']) && $item['correct']) ? 'bg-success' : ''?>"><?=chr(65+$index)?>. <?=$item['text']?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="panel-footer">
            难度：<?=$model->level / 100?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">试题解答</div>
        <div class="panel-body">
            <div>
                <h5>分析</h5>
                <div><?=$model->analyze?></div>
            </div>
            <div>
                <h5>解答</h5>
                <div><?=$model->answer?></div>
            </div>
            <div>
                <h5>点评</h5>
                <div><?=$model->comment?></div>
            </div>
        </div>
    </div>
</div>

