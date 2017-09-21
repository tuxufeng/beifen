<?php namespace app\wechat\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Wxconfig;

class System extends Controller{
    //动作
    public function post(Wxconfig $wxconfig){
        $model = $wxconfig->find(1)?:$wxconfig;
        if(IS_POST){
            $model->save(Request::post());
            return $this->setRedirect('refresh')->success('操作成功');
        }
        return view('',compact('model'));
    }
}
