<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSelectedDateFromPatientMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_messages', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('selected_date')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_messages', function (Blueprint $table) {
            //
            $table->datetime('selected_date')->after('telephone')->nullable(true);
        });
    }
}
