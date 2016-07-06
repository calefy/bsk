<?php
use common\models\BskQuestion;
use yii\helpers\Url;

if ($type == 1) { // 试题
    \common\assets\MathJax::register($this);
}

$this->title = '搜索结果';

$totalCount = $provider->getTotalCount();
$pagination = $provider->getPagination();
?>
<div class="exam-view wide">

    <?php if ($totalCount) : ?>
        <div class="wrap">
            <?php foreach($provider->getModels() as $index=>$item): ?>
                <?php $num = $pagination->getOffset() + $index + 1;?>
                <div class="panel panel-default">
                    <?php if ($type == 1) :?>
                        <div class="panel-body">
                            <div><?=$num . '. ' . BskQuestion::replaceFill($item)?></div>
                            <?php if ($item->type == BskQuestion::QUESTION_TYPE_SELECT): ?>
                            <div style="padding: 15px 20px 0" class="row">
                                <?php $opts = json_decode($item->info, true); ?>
                                <?php foreach($opts as $i => $opt): ?>
                                    <p class="col-sm-3"><?=chr(65 + $i)?>. <?=$opt['text']?></p>
                                <?php endforeach;?>
                            </div>
                            <?php endif;?>
                        </div>
                        <div class="panel-footer clearfix">
                            <a class="pull-right" href="<?=Url::to(['/question/view', 'id' => $item->id])?>" target="_blank">查看详情</a>
                            <span class="pull-right">难度：<?=$item->level / 100?> &emsp; </span>
                        </div>
                    <?php else : ?>
                        <div class="panel-body">
                            <a href="<?=Url::to(['/exam/view', 'id' => $item->id])?>" target="_blank"><?=$num . '. ' . $item->title?></a>
                        </div>
                    <?php endif ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <?=\yii\widgets\LinkPager::widget([ 'pagination' => $pagination])?>
        </div>
    <?php else : ?>
        <div class="well">暂无关于 “<?=Yii::$app->request->getQueryParam('text')?>” 的搜索结果</div>
    <?php endif ?>

</div>

