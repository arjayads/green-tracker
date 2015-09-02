<?php

namespace app\Services\Impl;

use Illuminate\Support\Facades\Config;
use app\Models\User;
use app\Models\Employee;
use app\ResponseEntity;
use app\Services\UserService;

class UserServiceImpl implements UserService
{
    public function __construct()
    {
    }

    function save(array $params)
    {
        $response = new ResponseEntity();

        try
        {
            $user = new User();
            $user->email = $params['email'];
            $user->password = bcrypt($params['password']);
            $user->status = 'ACTIVE';
            $user->save();

            $employee = new Employee();
            $employee->user_id = 10;
            $employee->employee_id = Config::get('hris_system.employee_id_prefix') . 10;
            $employee->first_name = $params['first_name'];
            $employee->last_name = $params['last_name'];
            $employee->middle_name = $params['middle_name'];
            $employee->sex = $params['sex'];
            $employee->birthday = '1990-11-20';
            $employee->department_id = $params['department_id'];
            $employee->position_id = $params['position_id'];
            $ok = $employee->save();

            if ($ok)
            {
                $response->setSuccess(true);
                $response->setMessages(['Employee successfully created!']);
            }
            else
            {
                $response->setMessages(['Failed to create employee!']);
            }
        }
        catch (\Exception $ex)
        {
            $response->setMessages([$ex->getMessage()]);
        }

        return $response;
    }
}