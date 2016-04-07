<?php
/**
 * 后台通用编辑器asset
 *
 * @author calefy
 * @date 2016-04-07
 */

namespace backend\assets;

use yii\web\AssetBundle;

class EditorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/bsk/editor.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'common\assets\CKEditor',
    ];
}


