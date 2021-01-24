<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {

		$table->id('id');
		$table->string('name',50);
		$table->datetime('date');
		$table->string('description',200);
		$table->integer('created_by_user',);
		$table->timestamps();
		$table->integer('service_id',)->nullable()->default('NULL');
		$table->datetime('finished_at')->nullable()->default('NULL');
		$table->foreign('service_id')->references('id')->on('services');
		$table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}