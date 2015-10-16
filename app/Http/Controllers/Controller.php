<?php

namespace app\Http\Controllers;

use app\Repositories\UserRepo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if (Auth::check()) {
            $userRepo = new UserRepo();
            $e = $userRepo->findEmployee(Auth::user()->id);
            View::share('myData', $e);
        }
    }
}
