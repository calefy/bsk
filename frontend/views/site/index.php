<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = '有效教育 —— 从必胜课网校开始！！';//Yii::$app->name;
?>
<div class="site-index">

    <!--荣誉榜-->
    <!--课程分类-->
    <!--广告-->
    <!--宣传定义-->
    <!--联系方式-->


    <?php
        //echo \common\widgets\DbCarousel::widget([
        //    'key'=>'index',
        //    'options' => [
        //        'class' => 'slide', // enables slide effect
        //    ],
        //])
    ?>

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
</div>
