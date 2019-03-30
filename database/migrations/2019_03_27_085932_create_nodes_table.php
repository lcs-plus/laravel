<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('节点名称');
            $table->integer('type')->default(0)->comment('上一级节点');
            $table->string('url')->comment('链接');
            $table->string('icon')->comment('图标')->nullable();
            $table->integer('sort')->comment('排序');
            $table->integer('state')->comment('状态');
            $table->integer('create_time');
            $table->integer('update_time');
            $table->integer('delete_time')->nullable();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `nodes` comment '节点表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
}
