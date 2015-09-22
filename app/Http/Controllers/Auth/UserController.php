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
use Illuminate\Support\Facades\Input;

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
        return $this->userDto->lists(Input::get('q'));
    }
}
