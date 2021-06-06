<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCloumnsKeydatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('keydates', function (Blueprint $table) {
            $table->string('type')->nullable(true)->change();    
            $table->string('next_test_order')->nullable(true)->change();    
            $table->string('lab_ref')->nullable(true)->change();    
            $table->string('results')->nullable(true)->change();
            $table->string('test_order')->nullable(true)->change();
            $table->datetime('apt_date')->nullable(true)->change();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('keydates', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('next_test_order');
            $table->dropColumn('lab_ref');
            $table->dropColumn('results');
            $table->dropColumn('test_order');
            $table->dropColumn('apt_date');
        });
        

    }
}
