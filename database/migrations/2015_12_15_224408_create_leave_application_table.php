<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table)
        {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->text('purpose')->nullable();
            $table->unsignedInteger('employee_id');
            $table->date('date_filed');
            $table->integer('no_of_days');  // total
            $table->unsignedInteger('created_by_user_id');
            $table->unsignedInteger('approved1_by_user_id')->nullable();
            $table->unsignedInteger('approved2_by_user_id')->nullable();
            $table->unsignedInteger('leave_type_id');
            $table->enum('status', ['Approved', 'Disapproved', 'Pending'])->default('Pending');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('restrict');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('approved1_by_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('approved2_by_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leave_applications');
    }
}
