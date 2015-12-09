<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('qc_user_id')->nullable()->index(); // quality control user
            $table->timestamp('qc_processed_datetime')->nullable();
            $table->unsignedInteger('sale_status_id')->nullable()->index();
            $table->unsignedInteger('user_id')->index();    // agent who entered the sale
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('customer_id')->index();
            $table->date('date_sold');
            $table->string('order_number');
            $table->tinyInteger('ninety_days')->default('0');
            $table->tinyInteger('verified')->default('0');
            $table->text('remarks');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('sale_status_id')->references('id')->on('sale_statuses')->onDelete('restrict');
            $table->foreign('qc_user_id')->references('id')->on('users')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
    }
}
