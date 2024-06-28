<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_images_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('task_id')->on('tasklist');
            $table->string('image_url', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}