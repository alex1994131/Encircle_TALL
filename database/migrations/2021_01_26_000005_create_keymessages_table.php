<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeymessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keymessages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->string('type');
            $table->string('test_order');
            $table->string('next_test_order');
            $table->string('lab_ref');
            $table->string('next_appointment');
            $table->dateTime('apt_date');
            $table->integer('campaign_num');
            $table->unsignedBigInteger('test_type_id');
            $table->string('result');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keymessages');
    }
}
