<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSayingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sayings', function (Blueprint $table) {
            $table->id();
            $table->string("sentence");
            $table->unsignedBigInteger("speakers");
            $table->unsignedBigInteger("writer_id");
            $table->string("description",160);
            $table->string("keywords",160);
            $table->timestamps();

            $table->foreign("speakers")->references("id")->on("speakers")->onDelete("cascade");
            $table->foreign("writer_id")->references("id")->on("authors")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sayings');
    }
}
