<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakultassTable extends Migration
{
    public function up()
    {
        Schema::create('fakultass', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fakultasname');
            $table->string('author');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
