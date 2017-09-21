<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Keyword;
use system\model\Module;
use system\model\Wxconfig;

class Api extends Controller{
    public function __construct()
    {
        WeChat::valid();
    }

    public function index(){
        $instance =WeChat::instance('message');
        if ($instance->isTextMsg()){
           $this->keyword($instance->Content);
           $message= Wxconfig::find(1);
           if($message){
               $instance->text($message['default_message']);
           }
        }
        if ($instance->isSubscribeEvent())
        {
            $model = Wxconfig::find(1);
            //向用户回复消息
            $instance->text($model['welcome']);
        }

    }

    public function keyword($content){
        $keyword = Keyword::where('keyword',$content)->first();
        if($keyword){
            $model = Module::where('name',$keyword['module'])->first();
            $module = $model['is_system']==1?'module':'addons';
            $class = $module.'\\'.$keyword['module'].'\\system\\Processor';
            call_user_func_array([new $class,'index'],[$keyword['module_id']]);
        }
    }
}
