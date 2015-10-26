<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/23/15
 * Time: 4:20 AM
 */

namespace app\Repositories;


use app\Models\Employee;
use app\Models\User;
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

        $q = $this->findWhereClause($q, $query);
        return $q->orderBy($sortCol, $direction)
            ->take($limit)
            ->skip($offset)
            ->get();
    }

    function find2($query = '')
    {
        return Employee::where('first_name', 'LIKE', ('%'.$query.'%'))->orWhere('last_name', 'LIKE', ('%'.$query.'%'))
            ->select([
                    'id',
                    DB::raw("CONCAT(last_name, ', ', first_name, ' ', middle_name) as full_name")
                ]
            )
            ->orderBy('last_name', 'asc')
            ->take(5)
            ->get();
    }

    function countFind($query = '') {
        $q = DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->leftJoin('shifts', 'employees.shift_id', '=', 'shifts.id');

        $q = $this->findWhereClause($q, $query);
        return $q->count();
    }

    function findBy($field, $kwari, array $cols = []) {

        $q = Employee::where($field, $kwari);
        if ($cols) {
            $q->select($cols);
        }
        return $q->first();

    }


    private function findWhereClause($q, $kwary) {
        if ($kwary && strlen($kwary) > 0) {
            $q->where('employees.id_number', 'LIKE', ('%'.$kwary.'%'))
                ->orWhere('employees.first_name', 'LIKE', ('%'.$kwary.'%'))
                ->orWhere('employees.middle_name', 'LIKE', ('%'.$kwary.'%'))
                ->orWhere('employees.last_name', 'LIKE', ('%'.$kwary.'%'))
                ->orWhere('users.email', 'LIKE', ('%'.$kwary.'%'));
        }

        return $q;
    }
}