<?php

namespace app\Http\Controllers\Admin;


use app\Http\Controllers\Controller;
use app\Http\Requests;

class MainController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return view('admin.index');
    }
}
