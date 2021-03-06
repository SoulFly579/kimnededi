<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('username');
            $table->string('email')->unique();
            $table->boolean('is_premium');
            $table->string("location");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verified_token')->nullable();
            $table->string('password');
            $table->boolean('is_two_factor');
            $table->text('two_factor_codes')->nullable();
            $table->unsignedBigInteger("premium_type")->nullable();
            $table->date("premium_finished_date")->nullable();
            $table->timestamps();

            $table->foreign("premium_type")->references("id")->on("premium_types");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
