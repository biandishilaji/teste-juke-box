<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTasksTable extends Migration
{
    public function up()
    {
        Schema::create('client_tasks', function (Blueprint $table) {
		$table->id('id')->length(20);
		$table->integer('task_id');
		$table->integer('client_id');
        $table->foreign('client_id')->references('id')->on('clients');		$table->foreign('task_id')->references('id')->on('tasks');
        $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_tasks');
    }
}