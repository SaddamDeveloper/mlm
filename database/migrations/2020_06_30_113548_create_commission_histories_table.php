<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_histories', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->integer('pair_number')->nullable();
            $table->double('amount')->nullable();
            $table->mediumText('comment')->nullable();
            $table->tinyInteger('status')->comment('1=credited,2=debited')->nullable();
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
        Schema::dropIfExists('commission_histories');
    }
}
