<?php namespace system\tag;
use houdunwang\view\build\TagBase;

class Tag extends TagBase {
	/**
	 * 标签声明
	 * @var array
	 */
    public $tags = [
        'line' => [ 'block' => false ],
        'next' => [ 'block' => false ],
        'prev' => [ 'block' => false ],
        'tag'  => [ 'block' => true, 'level' => 4 ],
        'category'  => [ 'block' => true, 'level' => 4 ],
        'slider'  => [ 'block' => true, 'level' => 4 ],
        'article'  => [ 'block' => true, 'level' => 4 ],

    ];
    //line 标签
    public function _line( $attr, $content, &$view ) {
        return 'link标签 测试内容';
    }

    //tag 标签
    public function _tag( $attr, $content, &$view ) {
        return 'tag标签 测试内容';
    }

//    导航条
    public function _category( $attr, $content, &$view ) {
        $pid = isset($attr['pid'])?$attr['pid']:-1;
        $str = <<<php
	   <?php \$db = Db::table(Category);
	   if($pid>=0){
	      \$db->where('pid',$pid);
	   }
	    \$data= \$db->get();
        foreach (\$data as \$v){ 
            \$v['url'] = __ROOT__.'/?s=home/entry/lists&cid=' . \$v['cid'];
            ?>
            $content
       <?php } ?>
php;
        return $str;
    }


    public function _slider( $attr, $content, &$view ) {
        $str = <<<php
	   <?php \$data = Db::table(Slider)->get();
        foreach (\$data as \$v){ ?>
            $content
       <?php } ?>
php;
        return $str;
    }


//    文章
    public function _article($attr, $content, &$view){
        $cid = isset($attr['cid'])?$attr['cid']:-1;
        $str = <<<php
        <?php \$db = Db::table(Article);
           if($cid>=0){
            \$db = \$db->where('category_cid',$cid)->where('thumb','!=','');
           }
        \$data = \$db->get();
        foreach(\$data as \$vv){
        \$vv['url'] = __WEB__ . '/' . \$vv['id'] . '.html';
            ?>
            $content
       <?php } ?>
php;
         return $str;
    }

//    下一篇
    public function _next(){
        $str = <<<php
       <?php
       \$id =Request::get('id');
       \$art =Db::table('article')->where('id','>',\$id)->first();
       if(\$art){
        echo "<a href='{\$art["id"]}.html'>".\$art['title']."</a>";
        }else{
        echo "这是最后一篇";
        }
        ?>
php;

        return $str;
    }

    public function _prev(){
        $str =<<<php
        <?php 
        \$id = Request::get('id');
        \$art = Db::table('article')->where('id','<',\$id)->orderBy('id','DESC')->first();
         if(\$art){
        echo "<a href='{\$art["id"]}.html'>".\$art['title']."</a>";
        }else{
        echo "这是第一篇";
        }
        ?>
php;
        return $str;
    }
}