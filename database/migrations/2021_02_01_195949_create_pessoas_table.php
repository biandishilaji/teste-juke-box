<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id('id');
            $table->string('name',50);
            $table->string('category',50);
            $table->string('code',50);
            $table->string('author',50);
            $table->boolean('ebook');
            $table->bigInteger('file_size',false,true)->nullable();
            $table->bigInteger('weight',false,true)->nullable();
            });
    }
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
