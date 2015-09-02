<?php

use Illuminate\Database\Seeder;

class SalariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salaries')->insert([
            [
                'user_id' => '1',
                'amount' => '30,000.00'
            ],
        ]);
    }
}
