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

    public function empList()
    {
        return $this->empDto->lists(Input::get('q'));
    }
}
