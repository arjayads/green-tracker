<?php

namespace app\Services\Impl;

use Illuminate\Support\Facades\Config;
use app\Models\User;
use app\Models\Employee;
use app\ResponseEntity;
use app\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            DB::transaction(function() use (&$response, $params)
            {
                $user = new User();
                $user->email = $params['email'];
                $temp_password = str_random(8);
                $user->password = bcrypt($temp_password);
                $user->active = '1';
                $user->save();

                $employee = new Employee();
                $employee->user_id = $user->id;
                $employee->id_number = Config::get('hris_system.employee_id_prefix') . $params['id_number'];
                $employee->first_name = $params['first_name'];
                $employee->last_name = $params['last_name'];
                $employee->middle_name = $params['middle_name'];
                $employee->sex = $params['sex'];
                $employee->birthday = Carbon::createFromFormat('m/d/Y', $params['birthday']);
                $employee->shift_id = $params['shift_id'];
                $employee->active = '1';
                $ok = $employee->save();

                if ($ok)
                {
                    $response->setSuccess(true);
                    $response->setMessages([
                        'Employee successfully created!', 
                        'Password for new user: ' . $temp_password
                    ]);
                }
                else
                {
                    $response->setMessages(['Failed to create employee!']);
                }
            });
        }
        catch (\Exception $ex)
        {
            $response->setMessages([$ex->getMessage()]);
        }

        return $response;
    }
}