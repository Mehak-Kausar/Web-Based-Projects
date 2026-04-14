<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordsTable extends Migration
{
    public function up()
    {
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->string('generated_password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passwords');
    }
}