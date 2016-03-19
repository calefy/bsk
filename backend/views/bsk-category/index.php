<?php

use yii\helpers\Html;
use yii\grid\GridView;

use kartik\tree\TreeView;
use common\models\BskCategory;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-category-index">

    <?php
        echo TreeView::widget([
            // single query fetch to render the tree
            // use the Product model you have in the previous step
            'query' => BskCategory::find()->addOrderBy('root, lft'),
            'headingOptions'=>['label'=> Yii::t('backend', 'Bsk Categories')],
            'isAdmin' => true,
            'iconEditSettings' => [
                'show' => 'none',
            ],
        ]);
    ?>

</div>

