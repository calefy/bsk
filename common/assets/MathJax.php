<?php
/**
 * 引入MathJax CDN
 *
 * @autor Calefy.Chen <clfsw0201@gmail.com>
 * @date 2016-03-28
 */

namespace common\assets;

use yii\web\AssetBundle;

class MathJax extends AssetBundle
{
    //const CDN = '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML';
    //const CDN = '//libs.cdnjs.net/mathjax/2.6.1/MathJax.js?config=TeX-AMS_HTML';
    const CDN = '//r.oss.chinabsk.cn/j/MathJax/MathJax.js?config=TeX-AMS_HTML';


    public $js = [
        self::CDN,
    ];
}


