<?php

namespace module\news\system;



use system\model\Article;

class Processor{
    public function index($mid){
        $model = Article::find($mid);
        $instance = WeChat::instance('message');
        if ($instance->isTextMsg()){
            //向用户回复消息
            $news=array(
                array(
                    'title'=>$model['title'],
                    'discription'=>$model['discription'],
                    'picurl'=>__ROOT__.'/'.$model['thumb'],
                    'url'=>'url'
                )
            );
            $instance->news($news);
        }
    }
}