<?php
/**
 * 试题分类页
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 */
class QuestionCategoryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/question.css',
    ];

    public $js = [
        'js/question.js',
    ];

    public $depends = [
        'frontend\assets\JsTreeAsset',
    ];
}

