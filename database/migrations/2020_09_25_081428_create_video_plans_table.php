<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_plans', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('youtube_id')->nullable();
            $table->tinyInteger('status')->comment('1=Enable,2=Disable')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_plans');
    }
}
