<?php

use Illuminate\Database\Seeder;

class LeaveTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->insert([
            [
                'id'  => '1',
                'description'   => 'Sick'
            ],
            [
                'id'  => '2',
                'description'   => 'Vacation'
            ],
            [
                'id'  => '3',
                'description'   => 'Birthday'
            ],
            [
                'id'  => '4',
                'description'   => 'Maternity'
            ],
            [
                'id'  => '5',
                'description'   => 'Paternity'
            ],
        ]);
    }
}
