<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPatientCampaignsTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_campaigns', function (Blueprint $table) {

            $table->unsignedBigInteger('trust_id')->after('patient_id')->nullable(true);
            $table->string('title')->after('trust_id');
            $table->string('content')->after('trust_id');            
            $table->string('msgs')->after('content');
            $table->enum('status', ['active', 'archive'])->default('active')->after('campaign_id');
            $table->enum('category', ['advice', 'appointment', 'result'])->default('advice')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_campaigns', function (Blueprint $table) {
            $table->dropColumn('trust_id');
            $table->dropColumn('title');
            $table->dropColumn('content');
            $table->dropColumn('msgs');
            $table->dropColumn('status');
            $table->dropColumn('category');
        });
    }
}
