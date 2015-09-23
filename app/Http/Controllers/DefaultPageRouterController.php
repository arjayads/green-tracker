<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;

class DefaultPageRouterController extends Controller
{
    function forward() {
        return redirect()->route('profile');
    }
}
