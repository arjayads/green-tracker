<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'name'       => 'Administrator',
                'default_url'   => '/emp'
            ],
            [
                'name'       => 'Manager',
                'default_url'   => '/emp'
            ],
            [
                'name'       => 'Agent',
                'default_url'   => '/profile'
            ],
            [
                'name'       => 'QA',
                'default_url'   => '/sales'
            ],
            [
                'name'       => 'QC',
                'default_url'   => '/sales'
            ]
        ]);

    }
}
