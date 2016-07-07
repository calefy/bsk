<?php
use yii\helpers\Url;
use yii\helpers\Html;

\frontend\assets\ExamCategoryAsset::register($this);

$this->title = '试卷分类查询';

$ads = getAds(['exam-top-banner', 'exam-bottom-banner']);
?>
<div class="site-exam wide">
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
                        <li><a href="<?=Url::to(array_merge(['/exam/category'], $req, ['g' => $grade['id'], 's' => $subject['id']]))?>"><?=$subject['name']?></a></li>
                    <?php endforeach ?>
                    <?php if ($index + 1 < count($gradeSubjects)): ?>
                        <li class="divider"></li>
                    <?php endif ?>
                <?php endforeach?>
            </ul>
        </div>
    </div>

    <div class="grade-filter clearfix">
        <div class="pull-left">
            <div class="btn-group">
                <button class="btn btn-default" data-toggle="dropdown">
                    <span><?=$curSyllabusName?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <?php foreach($syllabus as $item): ?>
                    <li><a href="<?=Url::to(array_merge(['/exam/category'], $req, ['l' => $item->id]))?>"><?=$item->name?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="pull-right">
            <?php foreach($semesters as $item): ?>
                <a href="<?=Url::to(array_merge(['/exam/category'], $req, ['m' => $item->id]))?>" class="<?=$req['m'] == $item->id ? 'active' : ''?>"><?=$item->name?></a>
            <?php endforeach ?>
        </div>
    </div>
<!--
    <div class="year-filter">
        <ul class="clearfix">
            <li><a href="">2016年</a></li>
            <li><a href="">2015年</a></li>
        </ul>
    </div>
-->

    <?php if (isset($ads['exam-top-banner'])): ?>
        <div class="ads-t">
            <?php foreach($ads['exam-top-banner']as $item):?>
                <img src="<?=$item->getImageUrl()?>" alt="<?=$item->text1?>"/>
            <?php endforeach?>
        </div>
    <?php endif?>

    <div class="list clearfix">
        <?php if (empty($extraCategories)): ?>
            <div class="well">暂无 “<?=$curGradeSubjectName . '->' . $curSyllabusName . '->' . $curSemesterName?>” 分类下的试卷</div>
        <?php else: ?>
            <div class="pull-left tree">
                <div id="exam-cat-tree"
                     data-current="<?=$req['c']?>"
                     data-categories="<?=Html::encode(json_encode($extraCategories))?>"
                     data-req="<?=Html::encode(json_encode($req))?>" ></div>
            </div>
            <div class="pull-right cnt">
                <div class="clearfix title">
                    <p class="pull-left">
                        您当前的位置：
                        <a href="/">必胜课</a> &gt;
                        <a href="<?=Url::to(array_merge(['/exam/category'], $req))?>"><?=$curGradeSubjectName?></a> &gt;
                        <a href="<?=Url::to(array_merge(['/exam/category'], $req))?>"><?=$curSemesterName?></a>
                    </p>
                    <p class="pull-right">
                        排序：
                        <?=$sort->link('title') ?> |
                        <?=$sort->link('created_at') ?>
                    </p>
                </div>
                <ul class="list-wrap">
                    <?php foreach($exams as $item): ?>
                    <li>
                        <h4><?=Html::a($item->title, ['/exam/view', 'id' => $item->id])?></h4>
                        <p><?=$item->description?></p>
                        <p class="foot">上传：<?=date('Y-m-d', $item->created_at)?> </p>
                    </li>
                    <?php endforeach?>
                    <?php if (empty($exams)): ?><div class="well">暂无试卷数据</div><?php endif?>
                </ul>
                <div class="text-center">
                    <?=\yii\widgets\LinkPager::widget([ 'pagination' => $pages ])?>
                </div>
            </div>
        <?php endif?>
    </div>

    <?php if (isset($ads['exam-bottom-banner'])): ?>
        <div class="ads-b">
            <?php foreach($ads['exam-bottom-banner']as $item):?>
                <img src="<?=$item->getImageUrl()?>" alt="<?=$item->text1?>"/>
            <?php endforeach?>
        </div>
    <?php endif?>
</div>

