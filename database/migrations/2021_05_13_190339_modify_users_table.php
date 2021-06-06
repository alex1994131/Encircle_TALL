<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {            
            $table->dropColumn('role');
            $table->string('department')->after('trust_id')->nullable(true);
            $table->string('jobtitle')->after('department')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {            
            $table->tinyInteger('role');
            $table->dropColumn('department');
            $table->dropColumn('jobtitle');
        });
    }
}
