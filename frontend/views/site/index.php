<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = '有效教育 —— 从必胜课网校开始！！';//Yii::$app->name;

$ads = getAds(['index-banner-ad', 'index-honors',
    'index-grades', 'index-blocks', 'index-contact']);
$honors = isset($ads['index-honors']) ? $ads['index-honors'] : [];
$bannerAd = isset($ads['index-banner-ad']) ? $ads['index-banner-ad'] : [];
?>
<div class="site-index">

    <!--荣誉榜-->
    <?php if ($honors): ?>
    <div class="index-honor wide">
        <ul class="clearfix">
            <?php foreach($honors as $item): ?>
            <li>
                <div class="avatar">
                    <img src="<?=$item->getImageUrl()?>" alt="">
                    <p><?=$item->text1?></p>
                </div>
                <div class="text"><?=$item->text2?></div>
            </li>
            <?php endforeach?>
        </ul>
    </div>
    <?php endif?>

    <!--课程分类-->
    <?php if (isset($ads['index-grades'])): ?>
    <div class="index-intro wide">
        <ul class="clearfix">
            <?php foreach($ads['index-grades'] as $item): ?>
            <li>
                <img src="<?=$item->getImageUrl()?>" alt=""/>
                <h4><?=$item->text1?></h4>
                <p><?=$item->text2?></p>
                <a href="<?=$item->url?>"><?=$item->text3?></a>
            </li>
            <?php endforeach?>
        </ul>
    </div>
    <?php endif ?>

    <!--广告-->
    <div class="wide">
        <?php foreach($bannerAd as $item):?>
            <img src="<?=$item->getImageUrl()?>" alt="<?=$item->text1?>"/>
        <?php endforeach?>
    </div>

    <!--宣传定义-->
    <?php if (isset($ads['index-blocks'])): ?>
    <div class="index-pics wide">
        <ul class="clearfix">
            <?php foreach($ads['index-blocks'] as $item): ?>
            <li>
                <a href="<?=$item->url?>">
                    <img src="<?=$item->getImageUrl()?>" alt=""/>
                    <?php if ($item->text1) : ?>
                    <h4><?=$item->text1?></h4>
                    <p><?=$item->text2?></p>
                    <?php endif ?>
                </a>
            </li>
            <?php endforeach?>
        </ul>
    </div>
    <?php endif ?>

    <!--联系方式-->
    <?php if (isset($ads['index-contact'])): ?>
    <div class="index-pics wide">
    <div class="index-contact wide clearfix">
        <?php foreach($ads['index-contact'] as $item): ?>
            <a href="<?=$item->url?>"><img src="<?=$item->getImageUrl()?>" alt=""></a>
        <?php endforeach?>
    </div>
    <?php endif ?>


    <?php
        //echo \common\widgets\DbCarousel::widget([
        //    'key'=>'index',
        //    'options' => [
        //        'class' => 'slide', // enables slide effect
        //    ],
        //])
    ?>

    <!--
    <div class="jumbotron">
        <h1>
            <img src="/img/logo.png" alt=""/>
            必胜课
        </h1>

        <p class="lead">今日养成网络教育</p>


        <?php
            //echo common\widgets\DbMenu::widget([
            //    'key'=>'frontend-index',
            //    'options'=>[
            //        'tag'=>'p'
            //    ]
            //])
        ?>
    </div>


    <div class="body-content">
        <h2>试卷</h2>

    <?php echo \yii\widgets\ListView::widget([
        'dataProvider'=>$examsProvider,
        'summaryOptions' => ['style' => 'margin-bottom: 15px;'],
        'pager'=>[
            'hideOnSinglePage'=>true,
        ],
        'itemView'=> function($model){
            $url = Url::to(['/exam/view', 'id' => $model->id]);
            return "<p><a href={$url}>{$model->title}</a></p> <hr/>";
        },
    ])?>

    </div>
    -->
</div>
