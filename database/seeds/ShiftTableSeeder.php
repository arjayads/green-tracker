<?php

use Illuminate\Database\Seeder;

class ShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shifts')->insert([
            [
                'description' => 'Night shift',
                'log_in' => '22:00',
                'log_out' => '07:00',
                'start_date' => '2015-01-01',
                'end_date' => '2015-12-31'
            ]
        ]);
    }
}
