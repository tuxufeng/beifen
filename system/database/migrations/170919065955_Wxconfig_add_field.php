<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class Wxconfig_add_field extends Migration {
    //执行
	public function up() {
		Schema::table( 'wxconfig', function ( Blueprint $table ) {
			//$table->string('name', 50)->add();
            $table->string('default_message')->add();
            $table->string('welcome')->add();
        });
    }

    //回滚
    public function down() {
            //Schema::dropField('wxconfig_add_field', 'name');
    }
}