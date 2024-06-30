<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_checklist_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistTable extends Migration
{
    public function up()
    {
        Schema::create('checklist', function (Blueprint $table) {
            $table->increments('checklist_id');
            $table->unsignedBigInteger('task_id');
            $table->text('checklist_item');
            $table->string('status', 50);
            $table->timestamps();

            $table->foreign('task_id')->references('task_id')->on('tasklist')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('checklist');
    }
}
