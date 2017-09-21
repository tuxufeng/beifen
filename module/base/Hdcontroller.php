<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18 0018
 * Time: 下午 9:19
 */
namespace module\base;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Module;

class Hdcontroller extends Controller {
    protected $template;
    public function __construct()
    {
        $m = Request::get('m');
        $model = Module::where('name',$m)->first();
        $module = $model['is_system']==1?'module':'addons';
        $this->template=$module.'/'.$m.'/view/';
        Middleware::set('auth');
    }
}