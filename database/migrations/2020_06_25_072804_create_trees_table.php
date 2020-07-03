<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('left_id')->nullable();
            $table->string('right_id')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('registered_by')->nullable();
            $table->string('left_count')->nullable();
            $table->string('right_count')->nullable();
            $table->string('total_left_count')->nullable();
            $table->string('total_right_count')->nullable();
            $table->string('total_pair')->nullable();
            $table->string('parent_leg')->comment('L=left,R=Right')->nullable();
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
        Schema::dropIfExists('trees');
    }
}
