<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('角色名称');
            $table->integer('state')->default(1)->comment('状态  1:启用；0：禁用');
            $table->integer('create_time');
            $table->integer('update_time');
            $table->integer('delete_time')->nullable();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `menus` comment '角色表'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
