<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\view\View;
use system\model\Slider as s;
class Slider extends Common {
    //动作
    public function lists(){
        $row = json_decode(v('config.content'),true);
        $data = s::paginate($row['row']?:10);
        return View('',compact('data'));
    }

    public function post(s $s){
        $id = Request::get('id');
        $model = $id?s::find($id):$s;
        if(IS_POST){
            $model->save(Request::post());
            return $this->setRedirect('slider.lists')->success('操作成功');
        }
        return View('',compact('model'));
    }

    public function delete(s $s){
        $id =Request::get('id');
        $model = $s->find($id);
        $model->destory();
        return $this->setRedirect('slider.lists')->success('删除成功');
    }
}
