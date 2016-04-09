<?php

namespace common\components\filesystem;

use Yii;
use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Adapter\NullAdapter;
use League\Flysystem\Config;
use OSS\OssClient;
use OSS\Core\OssException;

class OssAdapter extends NullAdapter
{

    /**
     * Constructor.
     *
     * @param OssClient $client
     * @param string   $bucket
     * @param string   $prefix
     * @param array    $options
     */
    public function __construct(OssClient $client, $bucket, $prefix = '', array $options = [])
    {
        $this->ossClient = $client;
        $this->bucket = $bucket;
        $this->setPathPrefix($prefix);
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function write($path, $contents, Config $config)
    {
        $object = $this->applyPathPrefix($path);
        try {
            $this->ossClient->putObject($this->bucket, $object, $contents);
            return true;
        } catch (OssException $e) {
            //print $e->getMessage();
            Yii::error($e);
        }
        return false;
    }

    public function has($path)
    {
        $object = $this->applyPathPrefix($path);
        try {
            return $this->ossClient->doesObjectExist($this->bucket, $object);
        } catch (OssException $e) {
            //print $e->getMessage();
            Yii::error($e);
        }
        return false;
    }

    public function read($path)
    {
        $arr = explode('/', $path);
        $object = array_pop($arr);
        try {
            return ['contents' => $this->ossClient->getObject($this->bucket, $object)];
        } catch (OssException $e) {
            //print $e->getMessage();
            Yii::error($e);
        }
        return false;
    }
}

