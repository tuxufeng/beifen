<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Config as c;
class Config extends Common {
    //动作
    public function post(c $c){
        $model =c::find(1)?c::find(1):$c;
        $res = json_decode($model['content'],true);
        if(IS_POST){
            $data = Request::post();
            $arr = [
               'content'=> json_encode($data)
            ];
            $model->save($arr);
            return $this->setRedirect('config.post')->success('操作成功');
        }
        return View('',compact('res'));
    }
}
