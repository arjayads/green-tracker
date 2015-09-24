<?php

namespace app\Http\Controllers;

use app\Repositories\UserRepo;
use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DefaultPageRouterController extends Controller
{
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    function forward() {
        $url = $this->userRepo->findDefaultUrl(Auth::user()->id);
        if ($url) {
            return redirect($url[0]);
        }
        return redirect()->route('profile');
    }
}
