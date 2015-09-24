<?php

namespace app\Http\Controllers;

use app\Repositories\UserRepo;

use app\Http\Requests;
use Illuminate\Support\Facades\Auth;

class DefaultPageRouterController extends Controller
{
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    function forward() {
        try {
            $url = $this->userRepo->findDefaultUrl(Auth::user()->id);
            return redirect($url[0]);
        }catch (\Exception $e) {
            return redirect()->route('profile');
        }
    }
}
