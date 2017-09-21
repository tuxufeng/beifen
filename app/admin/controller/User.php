<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\session\Session;
use houdunwang\view\View;
use system\model\User as u;
class User extends Controller{
    public function __construct()
    {
        Middleware::set('auth', ['only' => ['changePassword']]);
    }

    //动作
    public function login(u $u){
        if(IS_POST){
            return u::login(Request::post());
        }
        return View();
    }

    public function loginout(){
        Session::del('id');
        Session::del('username');

        return $this->setRedirect('user.login')->success('退出成功');
    }

    public function changePassword(u $u){
        if(IS_POST){
            $post = Request::post();
            if(!$u->changePassword($post)){
                return $this->error($u->getError());
            }
            return $this->setRedirect('refresh')->success('修改成功');
        }

        return View();
    }
}
