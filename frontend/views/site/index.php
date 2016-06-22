<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = '有效教育 —— 从必胜课网校开始！！';//Yii::$app->name;

$ads = getAds(['index-banner-ad', 'index-honors']);
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
    <div class="index-intro wide">
        <ul class="clearfix">
            <li>
                <img src="http://r.oss.chinabsk.cn/i/intro1.png" alt=""/>
                <h4>7年级课程</h4>
                <p>课程包含7年级各学科各阶段知识点、难点、精品题型详细解析以及老师视频课程辅导！</p>
                <a href="">马上开始学习</a>
            </li>
            <li>
                <img src="http://r.oss.chinabsk.cn/i/intro2.png" alt=""/>
                <h4>8年级课程</h4>
                <p>课程包含8年级各学科各阶段知识点、难点、精品题型详细解析以及老师视频课程辅导！</p>
                <a href="">马上开始学习</a>
            </li>
            <li>
                <img src="http://r.oss.chinabsk.cn/i/intro3.png" alt=""/>
                <h4>9年级课程</h4>
                <p>课程包含9年级各学科各阶段知识点、难点、精品题型详细解析以及老师视频课程辅导！</p>
                <a href="">马上开始学习</a>
            </li>
            <li>
                <img src="http://r.oss.chinabsk.cn/i/intro4.png" alt=""/>
                <h4>试卷精选</h4>
                <p>精选全国各地各阶段试卷，供同学们研习、巩固知识点！提高学习成绩！</p>
                <a href="">马上开始习题</a>
            </li>
            <li>
                <img src="http://r.oss.chinabsk.cn/i/intro5.png" alt=""/>
                <h4>精选题库</h4>
                <p>精选各阶段各科目母体、练习题，供同学们研习、巩固知识点！让同学们学会举一反三！</p>
                <a href="">马上开始习题</a>
            </li>
        </ul>
    </div>

    <!--广告-->
    <div class="wide">
        <?php foreach($bannerAd as $item):?>
            <img src="<?=$item->getImageUrl()?>" alt="<?=$item->text1?>"/>
        <?php endforeach?>
    </div>

    <!--宣传定义-->
    <div class="index-pics wide">
        <ul class="clearfix">
            <li class="pic1">
                <img src="http://r.oss.chinabsk.cn/i/pic1.jpg" alt="">
                <h4>合约式教学</h4>
                <p>简单介绍合约式教学的特点及好处</p>
            </li>
            <li class="pic2">
                <img src="http://r.oss.chinabsk.cn/i/pic2.jpg" alt="">
                <h4>微班教学</h4>
                <p>简单介绍微班式教学的特点及好处</p>
            </li>
            <li class="pic3">
                <img src="http://r.oss.chinabsk.cn/i/pic3.jpg" alt="">
                <h4>一对一教学</h4>
                <p>简单介绍一对一教学的特点及好处</p>
            </li>
            <li><img src="http://r.oss.chinabsk.cn/i/pic4.jpg" alt=""></li>
            <li><img src="http://r.oss.chinabsk.cn/i/pic5.jpg" alt=""></li>
            <li><img src="http://r.oss.chinabsk.cn/i/pic6.jpg" alt=""></li>
        </ul>
    </div>

    <!--联系方式-->
    <div class="index-contact wide clearfix">
        <a href=""><img src="http://r.oss.chinabsk.cn/i/contact1.png" alt=""></a>
        <a href=""><img src="http://r.oss.chinabsk.cn/i/contact2.png" alt=""></a>
        <a href=""><img src="http://r.oss.chinabsk.cn/i/contact3.png" alt=""></a>
        <!--
        <a href="">周一至周日 9:00-20:00 节假日 <em>0318-5705800</em></a>
        <a href=""><em>在线咨询</em> 点击这里马上在线沟通</a>
        <a href="">添加微信号<br/>服务在身边</a>
        -->
    </div>


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
