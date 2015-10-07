<?php

namespace app\Http\Controllers;

use app\Services\ProfileService;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    public function __construct(ProfileService $profileService) {
        $this->profileService = $profileService;
    }

    public function updatePhoto() {
        return $this->profileService->updatePhoto(Input::all())->toArray();
    }

    public function photo() {
        return $this->profileService->getPhoto();
    }
}
