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
    public function register()
    {
        Storage::extend('oss',function($app, $config){
            
        });
    }
}