<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("price");
            $table->string("features");
            $table->integer("the_period_of_validity");
            $table->string("type");
            $table->boolean("status")->default("0");
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
        Schema::dropIfExists('premium_types');
    }
}
