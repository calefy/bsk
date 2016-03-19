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

    <?php
        echo TreeView::widget([
            // single query fetch to render the tree
            // use the Product model you have in the previous step
            'query' => BskCategory::find()->based(),
            'headingOptions'=>['label'=> '基本分类'],
            'isAdmin' => true,
            'iconEditSettings' => [
                'show' => 'none',
            ],
        ]);
    ?>

</div>

