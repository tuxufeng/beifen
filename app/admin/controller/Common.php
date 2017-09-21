<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use houdunwang\session\Session;

class Common extends Controller{
    //动作
    public function __construct(){
        Middleware::set('auth');
    }
}
