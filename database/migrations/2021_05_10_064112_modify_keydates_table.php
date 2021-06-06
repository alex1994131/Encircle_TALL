<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyKeydatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keydates', function (Blueprint $table) {
            //for apt part
            $table->unsignedBigInteger('condition_id')->after('patient_id')->nullable(true);
            $table
            ->foreign('condition_id')
            ->references('id')
            ->on('conditions');
            $table->unsignedBigInteger('subcondition_id')->after('condition_id')->nullable(true);
            $table
            ->foreign('subcondition_id')
            ->references('id')
            ->on('subconditions');
            $table->datetime('apt_kickoff_date')->after('apt_date')->nullable(true);
            $table->unsignedBigInteger('apt_campaign_id')->after('apt_kickoff_date')->nullable(true);
            $table
            ->foreign('apt_campaign_id')
            ->references('id')
            ->on('patient_campaigns');
            $table->dropForeign(['test_type_id']);
            $table->dropColumn('test_type_id'); 
            $table->string('test_types')->after('apt_campaign_id')->nullable(true);
            //for result part
            $table->renameColumn('result', 'results');
            $table->datetime('result_date')->after('lab_ref')->nullable(true);
            $table->datetime('result_kickoff_date')->after('result_date')->nullable(true);
            $table->enum('result_type', ['normal', 'abnormal','no_results'])->after('result_kickoff_date')->default('normal');
            $table->unsignedBigInteger('result_campaign_id')->after('result_type')->nullable(true);
            $table
            ->foreign('result_campaign_id')
            ->references('id')
            ->on('patient_campaigns');
            $table->enum('next_apt_due', ['1Week','2Weeks','1Month'])->default('1Week')->after('result_campaign_id');
            $table->dropColumn('campaign_num');
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
            $table->dropForeign('condition_id');
            $table->dropColumn('condition_id');
            $table->dropForeign('subcondition_id');
            $table->dropColumn('subcondition_id');
            $table->dropColumn('apt_kickoff_date');
            $table->dropForeign(['apt_campaign_id']);
            $table->dropColumn('apt_campaign_id');
            $table
            ->foreign('test_type_id')
            ->references('id')
            ->on('test_types');    
            $table->unsignedBigInteger('test_type_id');
            $table->dropColumn('test_types');
            //for result part
            $table->renameColumn('results', 'result');
            $table->dropColumn('result_date');
            $table->dropColumn('result_kickoff_date'); 
            $table->dropColumn('result_type');
            $table->dropForeign('result_campaign_id');
            $table->dropColumn('result_campaign_id');
            $table->dropColumn('next_apt_due');
            $table->integer('campaign_num');
        });
    }
}
