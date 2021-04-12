<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('inspection_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('icon_id');

            $table->string('name');
            $table->string('description');
            $table->string('color');
            $table->foreign('icon_id')
                ->references('id')
                ->on('icons')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icons');
        Schema::dropIfExists('inspection_types');
    }
}
