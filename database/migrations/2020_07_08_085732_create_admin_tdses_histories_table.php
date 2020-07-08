<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTdsesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_tdses_histories', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('transaction_type')->comment('1=Cr,2=Dr')->nullable();
            $table->double('amount')->nullable();
            $table->double('total_amount')->nullable();
            $table->mediumText('comment')->nullable();
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
        Schema::dropIfExists('admin_tdses_histories');
    }
}
