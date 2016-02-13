<?php
/**
 * UMeditor中公式展示依赖资源
 *  见 https://github.com/mathquill/mathquill
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * @author chenlinfei <calefy.chen@qq.com>
 * @since 2016-02-01
 */
class MathQuill extends AssetBundle
{
    public $sourcePath = '@vendor/shiyang/yii2-umeditor/assets/third-party/mathquill';

    public $css = [
        'mathquill.css',
    ];

    public $js = [
        'mathquill.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

