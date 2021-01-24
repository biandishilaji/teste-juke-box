<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

		$table->increments('id');
		$table->string('name',50);
		$table->string('document',11);
		$table->string('email',100);
		$table->string('password',244);
		$table->timestamps();
		$table->datetime('email_verified_at')->nullable()->default('NULL');
		$table->datetime('logged_at')->nullable()->default('NULL');
		$table->datetime('deleted_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}