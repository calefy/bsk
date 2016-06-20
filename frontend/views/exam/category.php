<?php
use yii\helpers\Url;

\frontend\assets\ExamCategoryAsset::register($this);

$this->title = '试卷分类查询';
?>
<div class="site-exam wide">
    <div class="big-filter">
        <div class="btn-group">
            <button class="btn btn-default" data-toggle="dropdown">
                <span class="glyphicon glyphicon-menu-hamburger"></span>
                <span>初中数学</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-header">初中</li>
                <li><a href="#">数学</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">高中</li>
                <li><a href="#">数学</a></li>
                <li class="divider"></li>
            </ul>
        </div>
    </div>

    <div class="grade-filter clearfix">
        <div class="pull-left">
            <div class="btn-group">
                <button class="btn btn-default" data-toggle="dropdown">
                    <span>人教新版</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="">xxx版</a></li>
                </ul>
            </div>
        </div>
        <div class="pull-right">
            <a href="">中考试题</a>
            <a href="">中考试题</a>
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

    <div class="ads-t">
        <img src="http://r.oss.chinabsk.cn/i/ads1.jpg" alt=""/>
    </div>

    <div class="list clearfix">
        <div class="pull-left tree">
            <div id="exam-cat-tree">
              <ul>
                <li data-jstree='{"opened": true, "selected": true}'>
                    <a href="#">Root node 1</a>
                  <ul>
                    <li data-id="123321"> <a href="#">Root node 111</a> </li>
                    <li><a href="#">Child node 2</a></li>
                  </ul>
                </li>
                <li>Root node 1
                  <ul>
                    <li>Child node 1</li>
                    <li><a href="#">Child node 2</a></li>
                  </ul>
                </li>
              </ul>
            </div>
        </div>
        <div class="pull-right cnt">
            <div class="clearfix title">
                <p class="pull-left">
                    您当前的位置：
                    <a href="/">必胜课</a> &gt;
                    <a href="/exam/category">初中数学</a> &gt;
                    <a href="/exam/category">中考专题</a>
                </p>
                <p class="pull-right">
                    排序：
                    <a href="">试卷名称</a> |
                    <a href="">浏览次数</a> |
                    <a href="">下载次数</a> |
                    <a href="">上载日期</a>
                </p>
            </div>
            <ul>
                <li>
                    <h4>试卷title</h4>
                    <p>上传：2016-06-20  浏览：123次 下载：12次</p>
                </li>
            </ul>
        </div>
    </div>

    <div class="ads-b">
        <img src="http://r.oss.chinabsk.cn/i/ads1.jpg" alt=""/>
    </div>
</div>

