<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Category as c;
class Category extends Common {
    //动作
    public function lists(){
        $data =c::getCategory();
        return View('',compact('data'));
    }

//    c代表new c的模型，$c代表类实例化的对象
    public function post(c $c){
//        获得get的参数
        $num = Request::get('cid');
//        判断有没有get的cid参数，有就返回当前cid的数据，没有就返回对象
        $model = $num ? $c->find($num):$c;
       if(IS_POST){
           $model->save(Request::post());
           return $this->setRedirect('category.lists')->success('操作成功');
       }
        $data = c::getCategoryByCid($model);
        return View('',compact('data','model'));
    }

    public function delete(c $c){
        $cid = Request::get('cid');
        if(!$c->delete($cid)){
            return $this->error($c->getError());
        }
        return $this->setRedirect('category.lists')->success('删除成功');
    }
}
