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
            $table->bigIncrements('image_id'); // Ensure this is BigIncrements if using BigInteger
            $table->unsignedBigInteger('task_id'); // Match this with tasklist's task_id type
            $table->string('image_url', 255);
            $table->timestamps();

            $table->foreign('task_id')->references('task_id')->on('tasklist')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
