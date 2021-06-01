<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function($table) {
            $table->string('contact_name');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('email1');
            $table->string('email2');
            $table->string('comment');
            $table->string('number')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('contact_name');
            $table->dropColumn('phone1');
            $table->dropColumn('phone2');
            $table->dropColumn('email1');
            $table->dropColumn('email2');
            $table->dropColumn('comment');
            $table->integer('number')->change();
        });
    }
}
