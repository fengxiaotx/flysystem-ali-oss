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

class MSAliOssFilesystemServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function register()
    {

    }

    public function boot(){
        Storage::extend('oss',function($app, $config){

        });
    }
}