<?php
/**
 * Author: chenlinfei <clfsw0201@gamil.com>
 */

namespace common\actions;

use Yii;
use trntv\filekit\actions\UploadAction;

/**
 * 修改trntv/yii2-file-kit的uploadAction返回
 * 根据umeditor图片上传需要格式改造
 */

class UMeditorUploadAction extends UploadAction
{
    public function run()
    {
        $result = parent::run();
        $result = (!$this->multiple && count($result) === 1) ? array_shift($result) : $result;

        if (empty($result['error'])) {
            $result['state'] = 'SUCCESS';
        }

        return json_encode($result);
    }
}

