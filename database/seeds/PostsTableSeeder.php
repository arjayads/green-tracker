<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id'  => '1',
                'loves'   => '100',
                'content'   => 'Congratulations to Richard Ybias for his new business. Tangkit’s Bakeshop!'
            ],
            [
                'user_id'  => '2',
                'loves'   => '45',
                'content'   => 'Today is Gabriel Ceniza’s Birthday! Lets Greet him a Happy Birthday!!! wooooooh'
            ],
            [
                'user_id'  => '2',
                'loves'   => '786',
                'content'   => 'Richard Ybias, deserves to have a vacation because of his outstanding performance!'
            ],
        ]);
    }
}
