<?php namespace app\system\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;

class Back extends Controller{
    //动作
    public function lists(){
        $dirs = Backup::getBackupDir('backup');
        return view('',compact('dirs'));
    }

    public function backup() {
        $config = [
            'size' => 200,//分卷大小单位KB
            'dir'  => 'backup/' . date( "Ymdhis" ),//备份目录
        ];
        $status = Backup::backup( $config, function ( $result ) {
            if ( $result['status'] == 'run' ) {
//                //备份进行中
//                echo $result['message'];
//                //刷新当前页面继续下次
//                echo "<script>setTimeout(function()		{location.href='{$_SERVER['REQUEST_URI']}'},100);</script>";
                echo view('message',['content' => $result['message']]);
            } else {
                //备份执行完毕 返回备份列表
                echo $this->setRedirect('system.back.lists')->success($result['message']);
            }
        } );
        if($status===false){
            //备份过程出现错误
            echo  Backup::getError();
        }
    }

    public function recovery() {
        //要还原的备份目录
        $path = Request::get('path');
        $config=['dir'=>'backup/'.$path];
        $status = Backup::recovery( $config, function ( $result ) {
            if ( $result['status'] == 'run' ) {
                //还原进行中
//                echo $result['message'];
//                //刷新当前页面继续执行
//                echo "<script>setTimeout(function(){location.href='{$_SERVER['REQUEST_URI']}'},1000);</script>";
                echo view('message',['content' => $result['message']]);
            } else {
                //还原执行完毕
//                echo $result['message'];
                echo $this->setRedirect('system.back.lists')->success($result['message']);
            }
        } );
        if($status===false){
            //还原过程出现错误
            echo  Backup::getError();
        }
    }

    public function delete(){
        $path = 'backup/'.Request::get('path');
        Dir::del($path);
        return $this->setRedirect('system.back.lists')->success('备份删除成功');
    }
}
