<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sublist_of')->nullable();
            $table->string('name');

            $table->foreign('sublist_of')
                ->references('id')
                ->on('list_models');

            $table->timestamps();
        });

        Schema::create('list_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('list_model_id');
            $table->string('name');

            $table->foreign('list_model_id')
                ->references('id')
                ->on('list_models');

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
        Schema::dropIfExists('list_models');
        Schema::dropIfExists('list_values');
    }
}
