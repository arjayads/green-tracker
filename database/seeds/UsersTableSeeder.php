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
                'active'   => '1'
            ],
            [
                'email'    => 'arjay@verticalops.com',
                'password' => Hash::make('default'),
                'active'   => '1'
            ],
            [
                'email'    => 'test@verticalops.com',
                'password' => Hash::make('default'),
                'active'   => '1'
            ],
        ]);

        $r = range(4, 104);
        foreach($r as $v) {
            DB::table('users')->insert(
                [
                    'id'    =>  $v,
                    'email'    => 'john' . $v . '@verticalops.com',
                    'password' => Hash::make('john' . $v),
                    'active'   => '1'
                ]
            );
        }
    }
}
