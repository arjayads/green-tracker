<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepo
{
    function findAll()
    {
        return DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->select(
                'employees.id_number',
                'employees.first_name',
                'employees.last_name',
                'employees.birthday',
                'employees.sex'
            )
            ->get();
    }
}