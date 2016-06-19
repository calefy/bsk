<?php
/**
 * 试卷分类页
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ExamCategoryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/exam.css',
    ];

    public $js = [
        'js/exam.js',
    ];

    public $depends = [
        'frontend\assets\JsTreeAsset',
    ];
}

