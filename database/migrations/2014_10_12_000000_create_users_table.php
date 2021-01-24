<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id')->length(20);
            $table->string('name',50);
            $table->string('document',11);
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('logged_at')->nullable();
            $table->string('password',244);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
