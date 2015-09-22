<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'user_id'       => '1',
                'id_number'   => 'GWO-0422',
                'first_name'    => 'Jim',
                'last_name'     => 'Callanta',
                'middle_name'   => 'Hitgano',
                'sex'           => 'Male',
                'birthday'      => '1990-11-20',
                'active'        => '1',
                'shift_id'      => '1'
            ],
            [
                'user_id'       => '2',
                'id_number'   => 'GWO-0530',
                'first_name'    => 'Arjay',
                'last_name'     => 'Adong',
                'middle_name'   => 'test',
                'sex'           => 'Male',
                'birthday'      => '1990-11-20',
                'active'        => '1',
                'shift_id'      => '1'
            ],
            [
                'user_id'       => '2',
                'id_number'   => 'GWO-0130',
                'first_name'    => 'Ben',
                'last_name'     => 'Ten',
                'middle_name'   => '20',
                'sex'           => 'Female',
                'birthday'      => '1990-11-20',
                'active'        => '1',
                'shift_id'      => '1'
            ],
        ]);

        $r = range(4, 104);
        foreach($r as $v) {
            DB::table('employees')->insert(
                [
                    'user_id'    =>  $v,
                    'id_number'   => 'GWO-'.($v*1000),
                    'first_name'    => 'John'.$v,
                    'last_name'     => 'Doe'.$v,
                    'middle_name'   => 'Foo'.$v,
                    'sex'           =>  $v % 2 == 0 ? 'Male' : 'Female',
                    'birthday'      => '1990-11-20',
                    'active'        => '1',
                    'shift_id'      => '1'
                ]
            );
        }
    }
}
