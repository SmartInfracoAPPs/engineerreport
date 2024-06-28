<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_tasklist_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasklistTable extends Migration
{
    public function up()
    {
        Schema::create('tasklist', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('task_status', 50);
            $table->unsignedBigInteger('field_engineer_id');
            $table->foreign('field_engineer_id')->references('id')->on('users');
            $table->string('site_id', 255);
            $table->text('task_description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasklist');
    }
}

