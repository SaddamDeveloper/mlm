<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_rewards', function (Blueprint $table) {
            $table->id();
            $table->string('reward_name')->nullable();
            $table->string('bv_pair')->nullable();
            $table->tinyInteger('status')->comment("1=enabled,2=disabled")->default(1);
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
        Schema::dropIfExists('admin_rewards');
    }
}
