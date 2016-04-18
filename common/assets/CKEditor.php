<?php
/**
 * 引入CKEditor CDN
 *
 * @autor Calefy.Chen <clfsw0201@gmail.com>
 * @date 2016-03-28
 */

namespace common\assets;

use yii\web\AssetBundle;

class CKEditor extends AssetBundle
{
    public $js = [
        '//cdn.ckeditor.com/4.5.7/full-all/ckeditor.js',
    ];
}

