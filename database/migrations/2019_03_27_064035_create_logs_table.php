<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('ip');
            $table->integer('user_id')->nullable();
            $table->string('url');
            $table->string('table_name')->nullable();
            $table->integer('table_id')->nullable();
            $table->string('remark');
            $table->integer('create_time');
            $table->integer('update_time');
            $table->integer('delete_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
