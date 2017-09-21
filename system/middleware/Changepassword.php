<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;

class Changepassword implements Middleware{
	//执行中间件
	public function run($next) {
//         echo "中间件执行了";
        if(!Session::get('id')){
            die(go('admin.user.login'));
        }
         $next();
	}
}