<?php

namespace app\Http\Controllers;

use app\Models\User;
use app\Repositories\UserRepo;
use app\ResponseEntity;
use app\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct(ProfileService $profileService, UserRepo $userRepo) {
        $this->profileService = $profileService;
        $this->userRepo = $userRepo;
        parent::__construct();
    }

    public function index() {
        return view('profile');
    }

    public function updatePhoto() {
        return $this->profileService->updatePhoto(Input::all())->toArray();
    }

    public function updateCover() {
        return $this->profileService->updateCover(Input::all())->toArray();
    }

    public function updateInfo(Request $request) {

        $v = Validator::make($request->all(), [
            'password' => 'min:6|confirmed',
        ]);

        if ($v->fails()) {
            $response = new ResponseEntity();
            $response->setMessages((array)$v->errors()->getMessages());
            return $response->toArray();
        } else {
            return $this->profileService->save(Input::all())->toArray();
        }
    }

    public function photo() {
        return $this->profileService->getPhoto($this->userId);
    }

    public function cover() {
        return $this->profileService->getCover($this->userId);
    }

    public function myTeam() {

    }
}
