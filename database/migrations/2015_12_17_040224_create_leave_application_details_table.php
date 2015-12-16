<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveApplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_application_details', function (Blueprint $table)
        {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('leave_application_id');

            $table->foreign('leave_application_id')->references('id')->on('leave_applications')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leave_application_details');
    }
}
