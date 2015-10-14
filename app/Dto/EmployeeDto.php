<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/23/15
 * Time: 1:28 AM
 */

namespace app\Dto;


use app\Models\Employee;
use app\Repositories\EmployeeRepo;

class EmployeeDto {

    public function __construct()
    {
        $this->empRepo = new EmployeeRepo();
    }


    function findById($id) {
        return Employee::with('user', 'shift')->find($id);
    }


    function lists($q)
    {
        $rows = $this->empRepo->findAll($q);

        $result = [];
        if ($rows)
        {
            foreach($rows as $data)
            {
                $user['id_number'] = $data->id_number;
                $user['employee_id'] = $data->employee_id;
                $user['first_name'] = $data->first_name;
                $user['last_name'] = $data->last_name;
                $user['sex'] = $data->sex;
                $user['email'] = $data->email;
                $user['middle_name'] = $data->middle_name;
                $user['shift'] = $data->shift;
                $user['full_name'] = $data->last_name . ', ' . $data->first_name . ' ' . $data->last_name;

                $result[] = $user;
            }
        }

        return $result;
    }
}