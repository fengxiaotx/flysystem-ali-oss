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
        $this->setPathPrefix($prefix);
    }

    public function has($path){
        $object = $this->applyPathPrefix($path);
        return $this->client->doesObjectExist($this->bucket,$object);
    }

    public function read($path){}

    public function readStream($path){}

    public function listContents($directory = '', $recursive = false){}

    public function getMetadata($path){}

    public function getSize($path){}

    public function getMimetype($path){}

    public function getTimestamp($path){}

    public function write($path, $contents, Config $config = null){
        $object = $this->applyPathPrefix($path);
        if(self::isValidPath($contents)){
            return $this->client->uploadFile($this->bucket,$object,$contents);
        }else {
            return $this->client->putObject($this->bucket,$object,$contents);
        }

    }

    public function writeStream($path, $resource, Config $config = null){
		$object = $this->applyPathPrefix($path);
		if(is_resource($resource)){
			$f = "";
			while (!feof($resource)){
				$f.= fgets($resource);
			}
			return $this->client->putObject($this->bucket,$object,$f);
		}else{
			return $this->client->putObject($this->bucket,$object,$resource);
		}
    }

    public function update($path, $contents, Config $config){
        $this->delete($path);
        $this->write($path,$contents,$config);
    }

    public function updateStream($path, $resource, Config $config){
		$this->writeStream($path,$resource,$config);
	}

    public function rename($path, $newPath){}

    public function copy($path, $newPath){
        $fromPath = $this->applyPathPrefix($path);
        $toPath = $this->applyPathPrefix($newPath);
        return $this->client->copyObject($this->bucket,$this->bucket,$fromPath,$toPath);
    }

    public function delete($path){
        $object = $this->applyPathPrefix($path);
        return $this->client->deleteObject($this->bucket,$object);
    }

    public function deleteDir($dirname){}

    public function createDir($dirname, Config $config){}



    private function isValidPath($path){
        return preg_match('/(^\/\.*)|(^[a-zA-Z])\:\.*/',$path) && is_file($path);
    }


}