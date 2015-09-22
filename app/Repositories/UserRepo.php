<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepo
{
    function findAll()
    {
        return DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->leftJoin('shifts', 'employees.shift_id', '=', 'shifts.id')
            ->select(
                'users.email',
                'employees.id_number',
                'employees.first_name',
                'employees.middle_name',
                'employees.last_name',
                'employees.sex',
                'shifts.description as shift'
            )
            ->get();
    }
}