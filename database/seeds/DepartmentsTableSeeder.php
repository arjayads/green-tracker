<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'name' => 'administrator',
                'code' => 'gwo-321'
            ],
            [
                'name' => 'dev team',
                'code' => 'gwo-654'
            ],
            [
                'name' => 'customer service',
                'code' => 'gwo-987'
            ],
            [
                'name' => 'sales',
                'code' => 'gwo-012'
            ],
        ]);
    }
}
