<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasklistTable extends Migration
{
    public function up()
    {
        Schema::create('tasklist', function (Blueprint $table) {
            $table->increments('task_id');
            $table->string('task_status', 50);
            $table->unsignedInteger('field_engineer_id');
            $table->string('site_id', 255);
            $table->text('task_description');
            $table->timestamps();

            $table->foreign('field_engineer_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasklist');
    }
}
