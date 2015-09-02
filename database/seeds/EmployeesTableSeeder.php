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
                'employee_id'   => 'GWO-0422',
                'first_name'    => 'Jim',
                'last_name'     => 'Callanta',
                'middle_name'   => 'Hitgano',
                'sex'           => 'M',
                'birthday'      => '1990-11-20',
                'department_id' => '2',
                'position_id'   => '7'
            ],
            [
                'user_id'       => '2',
                'employee_id'   => 'GWO-0530',
                'first_name'    => 'Arjay',
                'last_name'     => 'Adong',
                'middle_name'   => 'test',
                'sex'           => 'M',
                'birthday'      => '1990-11-20',
                'department_id' => '2',
                'position_id'   => '5'
            ],
            [
                'user_id'       => '2',
                'employee_id'   => 'GWO-0130',
                'first_name'    => 'first_test',
                'last_name'     => 'last_test',
                'middle_name'   => 'middle_test',
                'sex'           => 'M',
                'birthday'      => '1990-11-20',
                'department_id' => '2',
                'position_id'   => '8'
            ],
        ]);
    }
}
