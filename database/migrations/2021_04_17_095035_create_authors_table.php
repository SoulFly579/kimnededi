<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("surname");
            $table->string("username");
            $table->string("email")->unique();
            $table->string("password");
            $table->string("location");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verified_token')->nullable();
            $table->string("slug");
            $table->string("phone");
            $table->text("address");
            $table->boolean('is_two_factor');
            $table->text('two_factor_codes')->nullable();
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
        Schema::dropIfExists('authors');
    }
}
