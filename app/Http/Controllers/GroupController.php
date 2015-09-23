<?php

namespace app\Http\Controllers;

use app\Models\Group;
use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;

class GroupController extends Controller
{

    public function groupList()
    {
        return Group::all();
    }
}
