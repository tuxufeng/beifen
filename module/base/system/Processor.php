<?php
namespace module\base\system;

use module\base\model\Basecontent;

class Processor{
    public function index($id){
        //此处处理微信操作
        $instance =WeChat::instance('message');
        $re = Basecontent::find($id);
        $instance->text($re['content']);
    }
}