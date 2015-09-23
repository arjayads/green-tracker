<?php

namespace app\Services;


use app\Models\Employee;
use app\Models\User;
use app\ResponseEntity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeService implements BaseService
{

    public function __construct()
    {
    }

    function save(array $params)
    {
        $response = new ResponseEntity();

        DB::transaction(function() use (&$response, $params)
        {
            $empId = isset($params['empId']) ? intval($params['empId']) : 0;
            $idNumber = Config::get('hris_system.employee_id_prefix') . $params['id_number'];
            $existingEmp = Employee::with('user')->find($empId);

            // check for duplicate id_number
            $tempEmp = Employee::where('id_number', '=', $idNumber)->first();

            if ($tempEmp) {
                if (!$existingEmp) { // new
                    $response->setMessages(['id_number' => ['Id number is already taken']]);
                    return $response;
                } else
                if ($existingEmp && $existingEmp->id != $tempEmp->id) { // update
                    $response->setMessages(['id_number' => ['Id number is already taken']]);
                    return $response;
                }
            }

            if ($empId > 0 && !$existingEmp) {   // check when updating
                $response->setMessages(['Employee is not available!']);
                return $response;
            } else {

                $user = $existingEmp ? $existingEmp->user : new User();
                $user->email = $params['email'];
                if (!$existingEmp) {    // for new employee user account
                    $user->password = Hash::make($idNumber); //default password is the ID Number of the employee
                    $user->active = '1';
                }
                $user->save();

                $employee = $existingEmp ? $existingEmp : new Employee();
                $employee->user_id = $user->id;
                $employee->id_number = $idNumber;
                $employee->first_name = $params['first_name'];
                $employee->last_name = $params['last_name'];

                if (isset($params['middle_name'])) {
                    $employee->middle_name = $params['middle_name'];
                }
                $employee->sex = $params['sex'];
                $employee->birthday = Carbon::createFromFormat('m/d/Y', $params['birthday']);
                $employee->shift_id = $params['shift_id'];
                $employee->active = $existingEmp ? $existingEmp->active : '1';
                $ok = $employee->save();

                if ($ok) {
                    $response->setSuccess(true);
                    $response->setData(['empId' => $employee->id]);
                    $response->setMessages(['Employee successfully ' . ($existingEmp ? 'saved' : 'created')]);
                } else {
                    $response->setMessages(['Failed to ' . (($existingEmp ? 'save' : 'create')) . ' employee!']);
                }
            }

        });
        return $response;
    }
}