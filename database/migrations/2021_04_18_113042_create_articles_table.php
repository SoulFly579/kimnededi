<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("writer_id");
            $table->string("title");
            $table->unsignedBigInteger("category_id");
            $table->text("content");
            $table->string("slug");
            $table->integer("status")->default("1");
            $table->integer("hit")->default("0");
            $table->text("like")->nullable();
            $table->text("dislike")->nullable();
            $table->string("description",160);
            $table->string("keywords",160);
            $table->timestamps();

            $table->foreign('writer_id')->references('id')->on('authors')->onDelete("cascade");
            $table->foreign('category_id')->references('id')->on('categories')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
