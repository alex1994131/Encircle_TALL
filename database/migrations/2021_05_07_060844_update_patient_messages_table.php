<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePatientMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_messages', function (Blueprint $table) {
            $table->string('msg_title')->after('library_id');
            $table->string('msg_text')->after('msg_title');
            $table->string('upload_video')->after('msg_text')->nullable(true);
            $table->string('upload_image')->after('upload_video')->nullable(true);
            $table->string('add_url')->after('upload_image')->nullable(true);
            $table->string('telephone')->after('add_url')->nullable(true);
            $table->datetime('selected_date')->after('telephone')->nullable(true);
            
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
            $table->dropColumn('msg_title');
            $table->dropColumn('msg_text');
            $table->dropColumn('upload_video');
            $table->dropColumn('upload_image');
            $table->dropColumn('add_url');
            $table->dropColumn('telephone');
            $table->dropColumn('selected_date');
        });
    }
}
