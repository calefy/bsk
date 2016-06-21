<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BskAdContent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Ad Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsk-ad-content-view">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'position_id',
                'value' => $model->adPosition->description,
            ],
            [
                'label' => '广告图片',
                'format' => 'html',
                'value' => $model->image_path ? Html::img($model->image_base_url . '/' . $model->image_path, ['class'=> 'mh200']) : '',
            ],
            'text1',
            'text2',
            'text3',
            //'status',
            //'updated_by',
            'updated_at:datetime',
            //'created_by',
            'created_at:datetime',
        ],
    ]) ?>

</div>
