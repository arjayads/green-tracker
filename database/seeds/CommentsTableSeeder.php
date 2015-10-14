<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'user_id'  => '1',
                'post_id'  => '1',
                'loves'   => '34',
                'content'   => 'Tangkit’s Bakeshop!, The bakeshop with the heart'
            ],
            [
                'user_id'  => '2',
                'post_id'  => '1',
                'loves'   => '2',
                'content'   => 'Sale: Pan de Kokoi'
            ],
            [
                'user_id'  => '2',
                'post_id'  => '2',
                'loves'   => '86',
                'content'   => 'HBD Master Gabe'
            ],
        ]);
    }
}
