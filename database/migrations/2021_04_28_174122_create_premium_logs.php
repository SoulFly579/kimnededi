<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_logs', function (Blueprint $table) {
            $table->id();
            $table->date("buyDate");
            $table->date("finishedDate");
            $table->unsignedBigInteger("buyId");
            $table->decimal("price");
            $table->timestamps();

            $table->foreign("buyId")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premium_logs');
    }
}
