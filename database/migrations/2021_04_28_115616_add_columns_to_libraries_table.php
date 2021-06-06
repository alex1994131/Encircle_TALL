<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('libraries', function (Blueprint $table) {
            //
            $table->dropColumn('content');
            $table->dropColumn('data');
            $table->dropColumn('published');
            
            $table->string('msg_title')->nullable(true);
            $table->text('msg_text')->nullable(true);
            $table->string('upload_video')->nullable(true);
            $table->string('upload_image')->nullable(true);
            $table->string('add_url')->nullable(true);
            $table->string('telephone')->nullable(true);
            $table->date('selected_date')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('libraries', function (Blueprint $table) {
            //
            $table->dropColumn('msg_title');
            $table->dropColumn('msg_text');
            $table->dropColumn('upload_video');
            $table->dropColumn('upload_image');
            $table->dropColumn('add_url');
            $table->dropColumn('telephone');
            $table->dropColumn('selected_date');
            
            $table->string('content');
            $table->string('data');
            $table->boolean('published');
        });
    }
}
