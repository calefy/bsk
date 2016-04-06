<?php
/**
 * 试题创建
 *
 * @author calefy
 * @date 2016-04-06
 */

namespace backend\assets;

use yii\web\AssetBundle;

class QuestionAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/bsk/question-form.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'common\assets\CKEditor',
    ];
}

