<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/23/15
 * Time: 4:20 AM
 */

namespace app\Repositories;


use Illuminate\Support\Facades\DB;

class EmployeeRepo {

    function find($sortCol = 'lastName', $direction = 'ASC', $offset = 0, $limit = 15, $query = '')
    {
        $q = DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->leftJoin('shifts', 'employees.shift_id', '=', 'shifts.id')
            ->select([
                    'users.email',
                    'employees.id as employee_id',
                    'employees.id_number',
                    'employees.first_name',
                    'employees.middle_name',
                    'employees.last_name',
                    'employees.sex',
                    'shifts.description as shift',
                    DB::raw("CONCAT(last_name, ', ', first_name, ' ', middle_name) as full_name")
                ]
            );
        if ($query && strlen($query) > 0) {
            $q->where('employees.id_number', 'LIKE', ('%'.$query.'%'))
                ->orWhere('employees.first_name', 'LIKE', ('%'.$query.'%'))
                ->orWhere('employees.middle_name', 'LIKE', ('%'.$query.'%'))
                ->orWhere('employees.last_name', 'LIKE', ('%'.$query.'%'))
                ->orWhere('users.email', 'LIKE', ('%'.$query.'%'));
        }

        return $q->orderBy($sortCol, $direction)
            ->take($limit)
            ->skip($offset)
            ->get();
    }

}