<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("writer_id");
            $table->unsignedBigInteger("article_id");
            $table->text("comment_text");
            $table->unsignedBigInteger("title_comment_id")->nullable();
            $table->text("like");
            $table->text("dislike");
            $table->timestamps();

            $table->foreign('writer_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('title_comment_id')->references('id')->on('comments')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
