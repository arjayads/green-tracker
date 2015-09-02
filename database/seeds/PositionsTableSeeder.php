<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            [
                'department_id' => '1',
                'name'          => 'CEO',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '1',
                'name'          => 'COO',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '1',
                'name'          => 'HR Manager',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '1',
                'name'          => 'HR Representative',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '2',
                'name'          => 'Sr Web Developer',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '2',
                'name'          => 'Sr Web Designer',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '2',
                'name'          => 'Jr Web Developer',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '2',
                'name'          => 'Jr Web Designer',
                'status'        => 'ACTIVE'
            ],
            [
                'department_id' => '3',
                'name'          => 'Team Leader',
                'status'        => 'ACTIVE'
            ],
        ]);
    }
}
