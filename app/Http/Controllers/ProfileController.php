<?php

namespace app\Http\Controllers;

use app\Models\User;
use app\Repositories\UserRepo;
use app\Services\ProfileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    public function __construct(ProfileService $profileService, UserRepo $userRepo) {
        $this->profileService = $profileService;
        $this->userRepo = $userRepo;
    }

    public function index() {
        $e = $this->userRepo->findEmployee(Auth::user()->id);
        return view('profile', ['myData' => $e]);
    }

    public function updatePhoto() {
        return $this->profileService->updatePhoto(Input::all())->toArray();
    }

    public function updateCover() {
        return $this->profileService->updateCover(Input::all())->toArray();
    }

    public function photo() {
        return $this->profileService->getPhoto();
    }

    public function cover() {
        return $this->profileService->getCover();
    }
}
