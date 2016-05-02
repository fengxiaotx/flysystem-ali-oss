<?php
/**
 * Created by Bane.Shi.
 * Copyright MoenSun
 * User: Bane.Shi
 * Date: 16/5/1
 * Time: 20:08
 */

namespace MoenSun\FlySystem;


use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Adapter\Polyfill\NotSupportingVisibilityTrait;
use League\Flysystem\Config;
use OSS\OssClient;

class MSAliOssAdapter extends AbstractAdapter
{
    use NotSupportingVisibilityTrait;

    protected $client;

    protected $bucket;

    public function __construct(OssClient $client,$bucket, $prefix = null)
    {
        $this->client = $client;
        $this->bucket = $bucket;
        $this->pathPrefix = $prefix;
    }

    public function has($path){}

    public function read($path){}

    public function readStream($path){}

    public function listContents($directory = '', $recursive = false){}

    public function getMetadata($path){}

    public function getSize($path){}

    public function getMimetype($path){}

    public function getTimestamp($path){}


    public function write($path, $contents, Config $config){
        return $this->client->putObject();
    }

    public function writeStream($path, $resource, Config $config){}

    public function update($path, $contents, Config $config){

    }

    public function updateStream($path, $resource, Config $config){}

    public function rename($path, $newPath){}

    public function copy($path, $newPath){}

    public function delete($path){}

    public function deleteDir($dirname){}

    public function createDir($dirname, Config $config){}


}