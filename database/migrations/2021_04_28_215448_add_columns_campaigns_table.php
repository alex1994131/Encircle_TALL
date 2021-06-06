<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('condition_id')->nullable()->after('content');
            $table->unsignedBigInteger('subCondition_id')->nullable()->after('condition_id');
            $table
                ->foreign('condition_id')
                ->references('id')
                ->on('conditions');
            $table
                ->foreign('subCondition_id')
                ->references('id')
                ->on('subconditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('condition_id');
            $table->dropColumn('subCondition_id');
            $table->dropForeign(['condition_id']);
            $table->dropForeign(['subCondition_id']);
        });
    }
}
