<?php

namespace app\Http\Controllers;

use app\Repositories\UserRepo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $userId;
    protected $employeeId;

    public function __construct()
    {
        if (Auth::check()) {
            $userRepo = new UserRepo();
            $e = $userRepo->findEmployee(Auth::user()->id);

            if ($e) {
                $this->employeeId = $e->id;
            }
            View::share('myData', $e);

            $id = Input::get('id');
            if ($id) {
                $this->userId = $id;
            } else {
                $this->userId = Auth::user()->id;
            }
        }
    }
}
