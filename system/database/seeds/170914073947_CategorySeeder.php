<?php namespace system\database\seeds;
use houdunwang\database\build\Seeder;
use houdunwang\db\Db;
class CategorySeeder extends Seeder {
    //执行
	public function up() {
		//Db::table('news')->insert(['title'=>'后盾人']);
		Db::table('category')->insert(['cname'=>'电子产品','orderby'=>'1','description'=>'大类','pid'=>'0']);
		Db::table('category')->insert(['cname'=>'家电','orderby'=>'1','description'=>'大类','pid'=>'0']);
		Db::table('category')->insert(['cname'=>'小家电','orderby'=>'1','description'=>'大类','pid'=>'0']);
		Db::table('category')->insert(['cname'=>'手机','orderby'=>'2','description'=>'子类','pid'=>'1']);
		Db::table('category')->insert(['cname'=>'电脑','orderby'=>'2','description'=>'子类','pid'=>'1']);
		Db::table('category')->insert(['cname'=>'电视机','orderby'=>'2','description'=>'子类','pid'=>'2']);
		Db::table('category')->insert(['cname'=>'豆浆机','orderby'=>'2','description'=>'子类','pid'=>'3']);
		Db::table('category')->insert(['cname'=>'小米手机','orderby'=>'3','description'=>'品牌','pid'=>'4']);

    }
    //回滚
    public function down() {

    }
}