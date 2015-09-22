<?php

namespace app\Services\Impl;

use Illuminate\Support\Facades\Config;
use app\Models\User;
use app\Models\Employee;
use app\ResponseEntity;
use app\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                $idNumber = Config::get('hris_system.employee_id_prefix') . $params['id_number'];

                $e = Employee::where('id_number', '=', $idNumber)->first();
                if ($e) {
                    $response->setMessages(['id_number' => ['Id number is already taken']]);
                } else {

                    $user = new User();
                    $user->email = $params['email'];
                    $user->password = Hash::make($idNumber); //default password is the ID Number of the employee
                    $user->active = '1';
                    $user->save();

                    $employee = new Employee();
                    $employee->user_id = $user->id;
                    $employee->id_number = $idNumber;
                    $employee->first_name = $params['first_name'];
                    $employee->last_name = $params['last_name'];
                    $employee->middle_name = $params['middle_name'];
                    $employee->sex = $params['sex'];
                    $employee->birthday = Carbon::createFromFormat('m/d/Y', $params['birthday']);
                    $employee->shift_id = $params['shift_id'];
                    $employee->active = '1';
                    $ok = $employee->save();

                    if ($ok) {
                        $response->setSuccess(true);
                        $response->setMessages(['Employee successfully created!']);
                    } else {
                        $response->setMessages(['Failed to create employee!']);
                    }
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