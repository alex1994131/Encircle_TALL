<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToSubconditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subconditions', function (Blueprint $table) {
            $table
                ->foreign('condition_id')
                ->references('id')
                ->on('conditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subconditions', function (Blueprint $table) {
            $table->dropForeign(['condition_id']);
        });
    }
}
