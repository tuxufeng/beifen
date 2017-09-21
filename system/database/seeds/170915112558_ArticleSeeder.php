<?php namespace system\database\seeds;
use houdunwang\database\build\Seeder;
use houdunwang\db\Db;
class ArticleSeeder extends Seeder {
    //执行
	public function up() {
		//Db::table('news')->insert(['title'=>'后盾人']);
		Db::table('article')->insert(['title'=>'后盾网','click'=>'','description'=>'后盾网介绍','content'=>'后盾网是一家做IT培训的机构','source'=>'网络','author'=>'张三','orderby'=>'1','linkurl'=>'','keywords'=>'后盾','iscommend'=>'1','ishot'=>'0','thumb'=>'','category_cid'=>'1']);
    }
    //回滚
    public function down() {

    }
}