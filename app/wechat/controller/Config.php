<?php namespace app\wechat\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Wxconfig;

class Config extends Controller{
    //动作
    public function setting(Wxconfig $wxconfig){
        $model = Wxconfig::find(1)?:$wxconfig;
        if(IS_POST){
            $data = [
                'content'=>json_encode(Request::post()),
            ];
            $model->save($data);
            return $this->setRedirect('wechat.config.setting')->success('操作成功');
        }
        $res = json_decode($model['content'],true);
        if(!$res){
            $res['token']=md5(time());
            $res['encodingaeskey']=md5(microtime(true)).'12345678901';
        }
        return View('',compact('res'));
    }
}
