<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('address')->insert([
            [
                'user_id' => '1',
                'address' => 'sample address'
            ],
        ]);
    }
}
