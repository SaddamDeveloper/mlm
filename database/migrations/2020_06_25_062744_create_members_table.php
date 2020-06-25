<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('login_id')->nullable();
            $table->string('password')->nullable();
            $table->string('sponsorID')->nullable();
            $table->string('full_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('adhar_card')->nullable();
            $table->mediumText('address')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ac_holder_name')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('account_no')->nullable();
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
        Schema::dropIfExists('members');
    }
}
