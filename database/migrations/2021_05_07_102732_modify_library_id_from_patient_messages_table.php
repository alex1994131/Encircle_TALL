<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLibraryIdFromPatientMessagesTable extends Migration
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
            $table->unsignedBigInteger('library_id')->nullable(true)->change();            
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
            $table->dropColumn('library_id');
        });
    }
}
