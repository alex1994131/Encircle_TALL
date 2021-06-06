<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateTimeFromKeydatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keydates', function (Blueprint $table) {
            //
            $table->date('apt_date')->nullable(true);
            $table->time('apt_time')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keydates', function (Blueprint $table) {
            //
            $table->dropColumn('apt_date');
            $table->dropColumn('apt_time');
        });
    }
}
