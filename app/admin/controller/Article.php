<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Article as a;
use system\model\Keyword;

class Article extends Common {
    //动作
    public function lists(){
        $row = json_decode(v('config.content'),true);
        $data = a::paginate($row['row']?:10);
        return View('',compact('data'));
    }

    public function post(a $a){

        $id = Request::get('id');
        $model = $id?$a->find($id):$a;
        if(IS_POST){
            $arr = Request::post();
            $re = Request::post('ishot');
            $arr['ishot']=!$re?0:1;
            $re1 = Request::post('iscommend');
            $arr['iscommend']=!$re1?0:1;
            $model->save($arr);
            //存完了文章，就该将关键词存入keyword表
            //有文章模型里的id，代表是修改文章
            $keyword = new Keyword();
            $kmodel = $id?$keyword->where('module_id',$id)->where('module','news')->first():$keyword;
                $data = [
                    'module'=>'news',
                    'keyword'=>$arr['keywords'],
                    'module_id'=>$model['id']
                ];
                $kmodel->save($data);
            return $this->setRedirect('article.lists')->success('操作成功');
        }
        $category = \system\model\Category::getCategory();
        return View('',compact('model','category'));
    }

    public function delete(a $a){
        $id =Request::get('id');
        $model = $a->find($id);
        $model->destory();
        return $this->setRedirect('article.lists')->success('删除成功');
    }
}
