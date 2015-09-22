<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepo
{
    function findAll($query)
    {
        $q = DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->leftJoin('shifts', 'employees.shift_id', '=', 'shifts.id')
            ->select(
                'users.email',
                'employees.id as employee_id',
                'employees.id_number',
                'employees.first_name',
                'employees.middle_name',
                'employees.last_name',
                'employees.sex',
                'shifts.description as shift'
            );
        if ($query && strlen($query) > 0) {
            $q->where('employees.id_number', 'LIKE', ('%'.$query.'%'))
                ->orWhere('employees.first_name', 'LIKE', ('%'.$query.'%'))
                ->orWhere('employees.middle_name', 'LIKE', ('%'.$query.'%'))
                ->orWhere('employees.last_name', 'LIKE', ('%'.$query.'%'))
                ->orWhere('users.email', 'LIKE', ('%'.$query.'%'));
        }

        return $q->get();
    }
}