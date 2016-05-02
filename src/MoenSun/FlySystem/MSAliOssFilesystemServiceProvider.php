<?php
/**
 * Created by Bane.Shi.
 * Copyright MoenSun
 * User: Bane.Shi
 * Date: 16/5/2
 * Time: 16:18
 */

namespace MoenSun\FlySystem;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use OSS\OssClient;

class MSAliOssFilesystemServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function register()
    {

    }

    public function boot(){
        Storage::extend('oss',function($app, $config){

            $client = new OssClient($config['OSS_ACCESS_ID'],$config['OSS_ACCESS_KEY'],$config['OSS_ENDPOINT'],$config['IS_CNAME'],$config['SECURITY_TOKEN']);
            
            return new Filesystem(new MSAliOssAdapter($client));
        });
    }
}