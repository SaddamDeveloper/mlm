<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_histories', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->nullable();
            $table->integer('user_id')->nullable();
            $table->mediumText('comment')->nullable();
            $table->tinyInteger('status')->comment('1=cr,2=dr')->default(1);
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
        Schema::dropIfExists('fund_histories');
    }
}
