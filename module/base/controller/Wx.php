<?php
namespace module\base\controller;

use houdunwang\request\Request;
use module\base\Hdcontroller;
use module\base\model\Basecontent;
use system\model\Keyword;
use system\model\Module;

class Wx extends Hdcontroller {
    public function lists(){
        $data = Db::table('keyword')->join('basecontent','keyword.module_id','=','basecontent.id')->where('module','base')->field('keyword.*,basecontent.content')->get();
        return view($this->template.'lists',compact('data'));
    }

    public function post(){
        $basecontent = new Basecontent();
        $keyword =new Keyword();
        $id = Request::get('id');
        $key = $id?$keyword->find($id):$keyword;
        $base = $key['module_id']?$basecontent->find($key['module_id']):$basecontent;
        if(IS_POST){
            $post = Request::post();
            $content = [
                'content'=>$post['content']
            ];
            $base->save($content);
            $word = [
                'module'=>Request::get('m'),
                'keyword'=>$post['keyword'],
                'module_id'=>$base['id'],
            ];
            $key->save($word);
            return $this->setRedirect(__ROOT__.url('wx/lists'))->success('操作成功');
        }
        return view($this->template.'post',compact('key','base'));
    }

    public function delete(){
        $id = Request::get('id');
        $model = Keyword::find($id);
        $mid = $model['module_id'];
        $basecontent = Basecontent::find($mid);
        $model->destory();
        $basecontent->destory();
        return $this->setRedirect(__ROOT__.url('wx/lists'))->success('删除成功');
    }

}