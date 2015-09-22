<?php

namespace app\Http\Controllers;

use app\Dto\EmployeeDto;
use app\Http\Requests;

class EmployeeController extends Controller
{
    private $empDto;

    public function __construct()
    {
        $this->empDto = new EmployeeDto();
    }


    public function detail($id)
    {
        $e = $this->empDto->findById($id);
        if ($e) {
            return view('employee.detail', ['employee' => $e]);
        } else {
            abort(404);
        }
    }
}
