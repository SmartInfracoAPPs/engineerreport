<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasklistTable extends Migration
{
    public function up()
    {
        Schema::create('tasklist', function (Blueprint $table) {
            $table->bigIncrements('task_id'); // Ensure this is bigIncrements if using BigInteger
            $table->string('task_status', 50);
            $table->unsignedBigInteger('field_engineer_id');
            $table->string('site_id', 255);
            $table->text('task_description');
            $table->timestamps();

            $table->foreign('field_engineer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasklist');
    }
}
