<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace app\home\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Article;
use system\model\Category;
use system\model\Module;


class Entry extends Controller
{
    protected $template;
    public function __construct()
    {
        $m = IS_MOBILE ? 'mobile' : 'web' ;
        $this->template = 'tpl/'.$m;
        define('__TEMPLATE__',$this->template);
        $this->runModule();
    }

    public function index()
    {
        return view($this->template.'/index.html');
    }

    //加载前台文章内容方法
    public function content($id){

        $model = Article::find($id);
        $category = Category::find($model['category_cid']);
        Db::table("article")->where('id',$id)->increment('click',1);
        return view($this->template.'/content.html',compact('model','category'));
    }

    //加载前台分类列表方法
    public function lists(){
        $category = Category::find(Request::get('cid'));
        return view($this->template.'/list.html',compact('category'));
    }

    //加载前台主题页面方法
    public function home(){

        return view($this->template . '/home.html');
    }


    public function runModule(){
        $m = Request::get('m');
        $action = Request::get('action');
        $info = explode('/',$action);
//        组合类
        $model = Module::where('name',$m)->first();
        if($model){
            $module = $model['is_system']==1?'module':'adons';
            $class = $module.'\\'.$m.'\\'.$info[0].'\\'.ucfirst($info[1]);
            die(call_user_func_array([new $class,$info[2]],[]));
        }

    }
}