<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrotendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frotends', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->mediumText('footer_text')->nullable();
            $table->mediumText('footer_address')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fb_id')->nullable();
            $table->string('tw_id')->nullable();
            $table->string('insta_id')->nullable();
            $table->string('yt_id')->nullable();
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
        Schema::dropIfExists('frotends');
    }
}
