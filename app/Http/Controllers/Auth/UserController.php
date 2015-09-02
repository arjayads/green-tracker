<?php

namespace app\Http\Controllers\Auth;

use app\Dto\UserDto;
use app\Http\Requests\CreateUserRequest;
use app\Http\Requests;
use app\Http\Controllers\Controller;
use app\Models\Employee;
use app\Models\User;
use app\Services\Impl\UserServiceImpl;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserServiceImpl();
        $this->userDto = new UserDto();
        $this->data['title'] = 'Users';
    }

    public function store(CreateUserRequest $request)
    {
        return $this->userService->save($request->except('_token'))->toArray();
    }

    public function userList()
    {
        return $this->userDto->lists();
    }

//    public function show($id = null)
//    {
//        if (!$id) {
////            $id = Auth::user()->id;
//            $id = 1;
//        }
//
//        $user = User::with('employee')->whereId($id)->first();
//
//        print json_encode($user);
//    }
//
//    public function index()
//    {
//        $users = User::with('employee')->get();
//
//        $this->data['users'] = json_encode($users);
//
//        return view('user.index', $this->data);
////        print json_encode($users);
//    }
//
//    public function create()
//    {
//        return view('user.create', $this->data);
//    }
}
