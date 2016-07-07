<?php
/**
 * 题库搜索分类页面
 */
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\BskQuestion;

\frontend\assets\QuestionCategoryAsset::register($this);
\common\assets\MathJax::register($this);

$this->title = '试题分类查询';

$ads = getAds(['question-bottom-banner']);
?>
<div class="site-question wide">
    <div class="big-filter">
        <div class="btn-group">
            <button class="btn btn-default" data-toggle="dropdown">
                <span class="glyphicon glyphicon-menu-hamburger"></span>
                <span><?=$curGradeSubjectName?></span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <?php foreach($gradeSubjects['leveled'] as $index=>$grade):?>
                    <li class="dropdown-header"><?=$grade['name']?></li>
                    <?php foreach($grade['subjects'] as $subject): ?>
                        <li><a href="<?=Url::to(array_merge(['/question/category'], $req, ['g' => $grade['id'], 's' => $subject['id']]))?>"><?=$subject['name']?></a></li>
                    <?php endforeach ?>
                    <?php if ($index + 1 < count($gradeSubjects)): ?>
                        <li class="divider"></li>
                    <?php endif ?>
                <?php endforeach?>
            </ul>
        </div>
    </div>

    <div class="main-filter">
        <table class="table table-bordered">
            <tr>
                <th>试题检索</th>
                <td>
                    <?php foreach($searchTypes as $key=>$val) : ?>
                        <a class="<?=$req['t'] == $key ? 'active' : ''?>" href="<?=Url::to(array_merge(['/question/category'], $req, ['t' => $key]))?>"><?=$val?></a>
                    <?php endforeach?>
                </td>
            </tr>
            <tr>
                <th>版本</th>
                <td>
                    <?php foreach($syllabus as $item) : ?>
                        <a class="<?=$req['l'] == $item->id ? 'active' : ''?>" href="<?=Url::to(array_merge(['/question/category'], $req, ['l' => $item->id]))?>"><?=$item->name?></a>
                    <?php endforeach?>
                </td>
            </tr>
            <tr>
                <th>年级及学期</th>
                <td>
                    <?php foreach($semesters as $item) : ?>
                        <a class="<?=$req['m'] == $item->id ? 'active' : ''?>" href="<?=Url::to(array_merge(['/question/category'], $req, ['m' => $item->id]))?>"><?=$item->name?></a>
                    <?php endforeach?>
                </td>
            </tr>
        </table>
    </div>

    <div class="list clearfix">
        <?php if (empty($extraCategories)): ?>
            <div class="well">暂无试题数据</div>
        <?php else: ?>
            <div class="pull-left tree">
                <div id="question-cat-tree"
                     data-current="<?=$req['c']?>"
                     data-categories="<?=Html::encode(json_encode($extraCategories))?>"
                     data-req="<?=Html::encode(json_encode($req))?>" ></div>
            </div>
            <div class="pull-right cnt">
                <div class="question-filter">
                    <div class="well">
                        <p>
                            <strong>题型</strong>
                            <?php foreach($questionTypes as $key=>$val): ?>
                                <a class="<?=$req['qt'] == $key ? 'active' : ''?>" href="<?=Url::to(array_merge(['/question/category'], $req, ['qt' => $key]))?>"><?=$val?></a>
                            <?php endforeach ?>
                        </p>
                        <p>
                            <strong>难度</strong>
                            <?php foreach($questionLevels as $key=>$val): ?>
                                <a class="<?=$req['ql'] == $key ? 'active' : ''?>" href="<?=Url::to(array_merge(['/question/category'], $req, ['ql' => $key]))?>"><?=$val?></a>
                            <?php endforeach ?>
                        </p>
                    </div>
                    <div class="well clearfix">
                        <div class="pull-right">共计<em><?=$pages->totalCount?></em>道相关题</div>
                        <p>
                            <strong>排序</strong>
                            <?=$sort->link('created_at') ?> |
                            <?=$sort->link('level') ?>
                        </p>
                    </div>
                </div>
                <div class="list-wrap">
                    <?php foreach($questions as $index => $item): ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div><?=($pages->getOffset() + $index + 1) . '. ' . BskQuestion::replaceFill($item)?></div>
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
                    </div>
                    <?php endforeach?>
                    <?php if (empty($questions)): ?><div class="well">暂无试题数据</div><?php endif?>
                </div>

                <!--分页-->
                <div class="text-center">
                    <?=\yii\widgets\LinkPager::widget([ 'pagination' => $pages ])?>
                </div>
            </div>
        <?php endif?>
    </div>

    <?php if (isset($ads['question-bottom-banner'])): ?>
        <div class="ads-b">
            <?php foreach($ads['question-bottom-banner']as $item):?>
                <img src="<?=$item->getImageUrl()?>" alt="<?=$item->text1?>"/>
            <?php endforeach?>
        </div>
    <?php endif?>
</div>

