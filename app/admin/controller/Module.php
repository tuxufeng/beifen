<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;

class Module extends Controller{
    //动作
    public function lists(){
        $data = \system\model\Module::where('is_system','!=',1)->get();
        return view('',compact('data'));
    }


    public function post(\system\model\Module $module){
        if(IS_POST){
            if(empty(Request::post('name'))){
                return $this->setRedirect('module.post')->success('模块名不能为空');
            }
            $preg = '/[a-zA-Z][a-zA-Z0-9]*/';
            $re = preg_match($preg,Request::post('name'));
            if(!$re){
                return $this->setRedirect('module.post')->success('模块名不能数字开头');
            }
            $model = \system\model\Module::where('name',Request::post('name'))->first();
            if($model){
                return $this->setRedirect('module.post')->success('该模块已存在');
            }
            $this->createModuleFile(Request::post('name'));
            $module->save(Request::post());
            return $this->setRedirect('module.lists')->success('操作成功');
        }

        return view();
    }

//    创建非系统模块目录文件的方法
    public function createModuleFile($name){
        $data = [
           'controller','model','view','system'
        ];
        foreach ($data as $v){
            Dir::create('addons/'.$name.'/'.$v);
        }
        $str =<<<hd
<?php
namespace addons\\{$name}\system;

class Processor{
    public function index(){
        //此处处理微信操作
    }
}
hd;
file_put_contents('addons/'.$name.'/system/Processor.php',$str);

    }

    public function delete(){
        $name = Request::get('name');
        Dir::del('addons/'.$name);
        $model = \system\model\Module::where('name',$name)->first();
        $model->destory();
        return $this->setRedirect('module.lists')->success('删除模块成功');
    }
}
