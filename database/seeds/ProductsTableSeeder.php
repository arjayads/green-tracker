<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'  => 'African Mango Pure',
                'campaign_id'   => '1'
            ],
            [
                'name'  => 'Renew Cleanse',
                'campaign_id'   => '1'
            ],

            [
                'name'  => 'KeraGro',
                'campaign_id'   => '2'
            ],
            [
                'name'  => 'KG - Outbound trial',
                'campaign_id'   => '2'
            ],

            [
                'name'  => 'Health Body Pro',
                'campaign_id'   => '3'
            ],
            [
                'name'  => 'Whole Fit Plus',
                'campaign_id'   => '3'
            ],
        ]);
    }
}
