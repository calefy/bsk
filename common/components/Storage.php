<?php
namespace common\components;

use trntv\filekit\File;

/**
 * Class Storage
 */
class Storage extends \trntv\filekit\Storage
{

    /**
     * @param $file string|\yii\web\UploadedFile
     * @param bool $preserveFileName
     * @param bool $overwrite
     * @return bool|string
     */
    public function save($file, $preserveFileName = false, $overwrite = false)
    {
        $fileObj = File::create($file);

        $this->beforeSave($fileObj->getPath(), $this->getFilesystem());

        $content = file_get_contents($fileObj->getPath());
        $path = md5($content) . '.' . $fileObj->getExtension();
        $filesystem = $this->getFilesystem();
        if ($filesystem->has($path)) {
            return $filesystem->getAdapter()->applyPathPrefix($path);
        }
        $success = $filesystem->write($path, $content);

        if ($success) {
            $this->afterSave($path, $filesystem);
            return $filesystem->getAdapter()->applyPathPrefix($path);
        }

        return false;
    }
}

