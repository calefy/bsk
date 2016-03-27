<?php

use yii\helpers\Html;
use yii\grid\GridView;

use kartik\tree\TreeView;
use common\models\BskCategory;

/* @var $this yii\web\View */

$this->title = '基本分类管理';
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-category-index">
    <p class="well text-danger">**注意：请慎重修改基本分类的层级关系，以免引起应用异常。</p>

    <?php
        echo TreeView::widget([
            // single query fetch to render the tree
            // use the Product model you have in the previous step
            'query' => BskCategory::find()->based(),
            'headingOptions'=>['label'=> '基本分类'],
            //'isAdmin' => true,
            'iconEditSettings' => [ // 不显示icon的编辑部分
                'show' => 'none',
            ],
            'rootOptions' => [ 'label' => '全部基本分类' ]
        ]);
    ?>

</div>

