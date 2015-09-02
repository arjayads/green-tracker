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
                'name'       => 'administrator',
                'permission' => ''
            ],
            [
                'name'       => 'dev team',
                'permission' => ''
            ],
            [
                'name'       => 'agents',
                'permission' => ''
            ],
        ]);
    }
}
