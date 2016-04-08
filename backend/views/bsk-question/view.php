<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\BskQuestion;

/* @var $this yii\web\View */
/* @var $model common\models\BskQuestion */

\common\assets\MathJax::register($this);

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Bsk Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $this->beginBlock('content'); ?>
<div class="bsk-question-view">

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

    <?php
        $types = BskQuestion::types();
        $items = json_decode($model->info, true);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3>（<?=$types[$model->type]?>）<?=BskQuestion::replaceFill($model)?></h3>
        </div>
        <div class="box-body">
            <?php if ($model->type == BskQuestion::QUESTION_TYPE_SELECT): ?>
                <?php foreach($items as $index=>$item): ?>
                    <p style="padding-left:20px;" class="<?=(isset($item['correct']) && $item['correct']) ? 'bg-green' : ''?>"><?=chr(65+$index)?>. <?=$item['text']?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="box-footer">
            难度：<?=$model->level / 100?>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-header">
            <h4>试题解析</h4>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th width="100">分析</th>
                        <td><?=$model->analyze?></td>
                    </tr>
                    <tr>
                        <th>解答</th>
                        <td><?=$model->answer?></td>
                    </tr>
                    <tr>
                        <th>点评</th>
                        <td><?=$model->comment?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $this->endBlock(); ?>
