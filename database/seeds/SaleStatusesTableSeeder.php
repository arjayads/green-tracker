<?php

use Illuminate\Database\Seeder;

class SaleStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale_statuses')->truncate();

        DB::table('sale_statuses')->insert([
            [
                'status'    => 'Dupe Sale'
            ],
            [
                'status'    => 'Same Day Cancellation'
            ],
            [
                'status'    => 'Sale'
            ],
            [
                'status'    => 'Dupe Form'
            ],
            [
                'status'    => 'Declines'
            ],
        ]);
    }
}
