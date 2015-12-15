<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;

class LeaveController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function apply() {
        return view('employee.apply-leave');
    }
}
