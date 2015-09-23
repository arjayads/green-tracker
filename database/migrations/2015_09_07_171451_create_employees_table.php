<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('id_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->enum('sex', ['Male', 'Female']);
            $table->date('birthday');
            $table->unsignedInteger('shift_id')->index();
            $table->unsignedInteger('supervisor_id')->index()->nullable();
            $table->smallInteger('active');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('restrict');
            $table->foreign('supervisor_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
