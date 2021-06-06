<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToPatientTrustTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_trust', function (Blueprint $table) {
            $table
                ->foreign('trust_id')
                ->references('id')
                ->on('trusts');
            $table
                ->foreign('patient_id')
                ->references('id')
                ->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_trust', function (Blueprint $table) {
            $table->dropForeign(['trust_id']);
            $table->dropForeign(['patient_id']);
        });
    }
}
