<?php


namespace logier;


use think\Controller;
use think\helper\Str;

class LogBaseController extends Controller
{

    public function index()
    {

        $item = $this->scandir();
        $this->assign('list', $item);
        return $this->fetch(__DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'index.html');
    }

    public function open_dir()
    {
        $path =$this->request->param('dir');
        $item = $this->scandir($path);
        $this->assign('list', $item);
        return $this->fetch(__DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'index.html');
    }
    public function open_file(){
        $log_path = $this->app->getRuntimePath() . 'log'.DIRECTORY_SEPARATOR;
        $path =$log_path.$this->request->param('path');
        if (!is_file($path)){
            echo '文件不存在在';
        }
        $file = file_get_contents($path);

        $arr = explode(PHP_EOL,$file);
        $logs = [];
        foreach ($arr as $key=> $item){
            if (!empty($item)){
                $log =  json_decode($item,true);
                $log['id']=$key;
                $log['time']=strtotime($log['timestamp']);
                $logs[]= $log;
            }
        }
        array_multisort($logs,SORT_NUMERIC,array_column($logs,'time'));
        $this->assign('list', $logs);
        return $this->fetch(__DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'FileInfo.html');

    }
    private function scandir($dir = '')
    {
        $log_path = $this->app->getRuntimePath() . 'log';
        if (empty($dir)) {
            $scandir = $log_path;
        }else{
            $scandir=$log_path.DIRECTORY_SEPARATOR.$dir;
        }
        $paths = scandir($scandir);
        foreach ($paths as $item) {
            if ($item !== "." && $item !== "..") {
               $file_name = $log_path .DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$item;
               $file_type=  is_file($file_name) ? 'file' : 'dir';
                $difs[] = [
                    'file_type' =>$file_type,
                    'path' => $file_name,
                    'min_path'=>$dir.'/'.$item,
                    'create_time'=>is_file($file_name)?filectime($file_name):''
                ];
            }
        }

        array_multisort($difs,SORT_NUMERIC,array_column($difs,'create_time'));
        foreach ($difs as $key =>$item){
            if (!empty($item['create_time'])){
                $difs[$key]['create_time'] =date("Y-m-d H:i:s",$item['create_time']);
            }
        }
        return $difs;
    }
}