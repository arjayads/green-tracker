<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('mood')->nullable();
            $table->string('alias')->nullable();
            $table->smallInteger('active');
            $table->rememberToken();
            $table->unsignedInteger('profile_photo_file_id')->nullable();
            $table->unsignedInteger('cover_photo_file_id')->nullable();
            $table->unsignedInteger('supervisor_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('profile_photo_file_id')->references('id')->on('files')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('cover_photo_file_id')->references('id')->on('files')->onUpdate('cascade')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
