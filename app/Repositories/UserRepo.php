<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepo
{
    function findAll()
    {
        return DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'employees.employee_id',
                'employees.first_name',
                'employees.last_name',
                'employees.birthday',
                'employees.sex',

                'positions.name as position',
                'departments.name as department'
            )
            ->get();
    }
}