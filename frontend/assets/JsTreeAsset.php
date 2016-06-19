<?php
/**
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class JsTreeAsset extends AssetBundle
{
    public $sourcePath = '@bower/jstree';
    public $css = [
        'dist/themes/default/style.min.css'
    ];
    public $js = [
        'dist/jstree.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

