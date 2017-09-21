<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Config;
use system\model\Wxconfig;

class Auth implements Middleware{
	//执行中间件
	public function run($next) {
//         echo "中间件执行了";
         $config =Config::find(1);
         if($config){
            $config = $config->toArray();
         }
         v('config',$config);
         $this->wxconfig();
         $next();
	}

	public function wxconfig(){
        $model = Wxconfig::find(1)?:new Wxconfig();
        $res = json_decode($model['content'],true);
        if($res){
            $data = array_merge(c('wechat'),$res);
            c('wechat',$data);
        }

    }
}