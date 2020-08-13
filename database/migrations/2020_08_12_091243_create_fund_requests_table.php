<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_requests', function (Blueprint $table) {
            $table->id();
            $table->double('fund')->nullable();
            $table->string('attachment')->nullable();
            $table->mediumText('comment')->nullable();
            $table->tinyInteger('status')->comment('1=active,2=deactive')->default(1);
            $table->integer('added_by')->nullable();
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
        Schema::dropIfExists('fund_requests');
    }
}
