<?php
/**
 * treeInput asset，修改原控件单选方式，只能选择叶子节点
 *
 * @author calefy
 * @date 2016-04-07
 */

namespace backend\assets;

use yii\web\AssetBundle;

class TreeInputAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/bsk/treeInput.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}



