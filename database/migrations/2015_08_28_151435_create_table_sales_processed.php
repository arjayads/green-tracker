<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSalesProcessed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_processed', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('qc_user_id')->index(); // quality control user
            $table->unsignedInteger('sale_status_id')->index();
            $table->unsignedInteger('user_id')->index();    // agent entered the sale data
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('customer_id')->index();
            $table->date('date_sold');
            $table->string('order_number');
            $table->tinyInteger('ninety_days')->default('0');
            $table->text('remarks');
            $table->timestamp('entered_datetime');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('qc_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('sale_status_id')->references('id')->on('sale_statuses')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_processed');
    }
}
