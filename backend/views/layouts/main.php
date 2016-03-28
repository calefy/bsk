<?php
/**
 * @var $this yii\web\View
 */
?>
<?php $this->beginContent('@backend/views/layouts/common.php'); ?>
    <?php if (isset($this->blocks['content'])): ?>
        <?=$this->blocks['content']?>
    <?php else: ?>
        <div class="box">
            <div class="box-body">
                <?php echo $content ?>
            </div>
        </div>
    <?php endif; ?>
<?php $this->endContent(); ?>
