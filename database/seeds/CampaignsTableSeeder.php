<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert([
            [
                'name'       => '41Media'
            ],
            [
                'name'       => 'Adboom',
            ],
            [
                'name'       => 'CMS',
            ],
        ]);
    }
}
