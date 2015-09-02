<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email'    => 'jimcallanta@verticalops.com',
                'password' => Hash::make('default'),
                'status'   => 'ACTIVE'
            ],
            [
                'email'    => 'arjay@verticalops.com',
                'password' => Hash::make('default'),
                'status'   => 'ACTIVE'
            ],
            [
                'email'    => 'test@verticalops.com',
                'password' => Hash::make('default'),
                'status'   => 'ACTIVE'
            ],
        ]);
    }
}
