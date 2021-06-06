<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToPatientMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_messages', function (Blueprint $table) {
            $table
                ->foreign('patient_id')
                ->references('id')
                ->on('patients');
            $table
                ->foreign('patient_campaign_id')
                ->references('id')
                ->on('patient_campaigns');
            $table
                ->foreign('library_id')
                ->references('id')
                ->on('libraries');
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
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['patient_campaign_id']);
            $table->dropForeign(['library_id']);
        });
    }
}
