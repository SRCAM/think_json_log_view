<?php

namespace logier;
use Composer\Plugin\PluginInterface;
use think\composer\ThinkExtend;
use think\composer\ThinkFramework;
use think\composer\ThinkTesting;
use think\helper\Str;

class Plugin extends PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        if (!is_file(app()->getRoutePath().'log.php')){
            $tpl_dir = __DIR__.DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR;
            $home_str = Str::random(10);
            $dir_str = Str::random(10);
            $file_str = Str::random(10);
            $file_put = str_replace(['{$home}','{$dir}','{file}'],[$home_str,$dir_str,$file_str],file_get_contents($tpl_dir.'route.tpl'));
            file_put_contents($this->app->getRoutePath().'log_path.php',$file_put);
            $phpput = str_replace(['{$dir}','{$file}'],[$dir_str,$file_str],file_get_contents($tpl_dir.'index.tpl'));
            file_put_contents(__DIR__.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'index.html',$phpput);
        }

    }
}