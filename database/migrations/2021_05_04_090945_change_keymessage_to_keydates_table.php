<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKeymessageToKeydatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keymessages', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['test_type_id']);
        });
        Schema::rename('keymessages', 'keydates');
        Schema::table('keydates', function (Blueprint $table) {
            $table
                ->foreign('patient_id')
                ->references('id')
                ->on('patients');
            $table
                ->foreign('test_type_id')
                ->references('id')
                ->on('test_types');
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
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['test_type_id']);
        });
        Schema::rename('keydates', 'keymessages');        
        Schema::table('keymessages', function (Blueprint $table) {
            $table
                ->foreign('patient_id')
                ->references('id')
                ->on('patients');
            $table
                ->foreign('test_type_id')
                ->references('id')
                ->on('test_types');
        });
    }
}
