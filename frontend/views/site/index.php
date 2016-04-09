<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = '有效教育 —— 从必胜课网校开始！！';//Yii::$app->name;
?>
<div class="site-index">

    <?php
        //echo \common\widgets\DbCarousel::widget([
        //    'key'=>'index',
        //    'options' => [
        //        'class' => 'slide', // enables slide effect
        //    ],
        //])
    ?>

    <div class="jumbotron">
        <h1>必胜课</h1>

        <p class="lead">今日养成网络教育培训中心</p>


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

        <?php echo GridView::widget([
            'tableOptions' => ['class' => 'table table-striped'],
            'headerRowOptions' => ['class' => 'hide'],
            'dataProvider' => $examsProvider,
            'columns' => [
                [
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::a($model->title, ['/']);
                    }

                ]
            ],
        ]); ?>

    </div>
</div>
