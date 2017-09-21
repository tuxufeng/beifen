<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class Article extends Migration {
    //执行
	public function up() {
		Schema::create( 'article', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
            $table->string('title');
            $table->smallint('click')->unsigned();
            $table->string('description');
            $table->mediumtext('content');
            $table->string('source');
            $table->string('author');
            $table->smallint('orderby')->unsigned();
            $table->string('linkurl');
            $table->string('keywords');
            $table->string('iscommend')->comment('是否推荐');
            $table->string('ishot')->comment('是否热门');
            $table->string('thumb');
            $table->smallint('category_cid')->unsigned()->comment('和栏目表的关联字段');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'article' );
    }
}