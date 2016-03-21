<?php

use yii\helpers\Html;
use common\helpers\EnumHelper;
use common\models\BskCategoryOther;


/* @var $this yii\web\View */
/* @var $model common\models\BskCategoryOther */

$types = EnumHelper::categoryTypes();

$type = Yii::$app->request->get('tag');
$type = isset($types[$type]) ? $type : BskCategoryOther::CATEGORY_TYPE_POINT;

$this->title = Yii::t('backend', 'Create') . $types[$type] . '分类';
$this->params['breadcrumbs'][] = Yii::t('backend', 'Bsk Categories');
$this->params['breadcrumbs'][] = ['label' => '扩展分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-category-other-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
