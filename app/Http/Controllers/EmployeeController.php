<?php

namespace app\Http\Controllers;

use app\Dto\EmployeeDto;
use app\Http\Requests;
use app\Services\EmployeeService;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{
    public function __construct(EmployeeService $empService, EmployeeDto $empDto)
    {
        $this->empService = $empService;
        $this->empDto = $empDto;
    }

    public function store(Requests\CreateEmployeeRequest $request)
    {
        return $this->empService->save($request->except('_token'))->toArray();
    }

    public function detail($id)
    {
        $e = $this->empDto->findById($id);
        if ($e) {
            return view('emp.detail', ['employee' => $e]);
        } else {
            abort(404);
        }
    }


    public function edit($id)
    {
        $e = $this->empDto->findById($id);
        if ($e) {
            return view('emp.edit', ['employee' => $e]);
        } else {
            abort(404);
        }
    }

    public function getForEdit($id)
    {
        $data = [];
        $e = $this->empDto->findById($id);
        if ($e) {
            $data['empId'] = $e->id;
            $data['id_number'] = substr($e->id_number, 4);
            $data['first_name'] = $e->first_name;
            $data['middle_name'] = $e->middle_name;
            $data['last_name'] = $e->last_name;
            $data['sex'] = $e->sex;
            $data['birthday'] = $e->birthday;
            $data['email'] = $e->user->email;
            $data['shift'] = ['id' => $e->shift->id];
        }
        return $data;
    }

    public function empList()
    {
        return $this->empDto->lists(Input::get('q'));
    }
}
