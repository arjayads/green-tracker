<?php

namespace app\Http\Controllers;
 
use app\Repositories\SaleRepo;
use app\Repositories\UserRepo;
use app\ResponseEntity;
use app\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct(ProfileService $profileService, UserRepo $userRepo, SaleRepo $saleRepo) {
        $this->profileService = $profileService;
        $this->userRepo = $userRepo;
        $this->saleRepo = $saleRepo;
        parent::__construct();
    }

    public function index() {

        $menu = [];
        $groups = Auth::user()->groups();

        if (in_array('Administrator', $groups)) {
            $menu[] = ['text' => 'Sales', 'url' => '/sales'];
            $menu[] = ['text' => 'Create Sale', 'url' => '/sales/create'];
            $menu[] = ['text' => 'Employees', 'url' => '/emp'];
        } else if (in_array('Agent', $groups)) {
            $menu[] = ['text' => 'Create Sale', 'url' => '/sales/create'];
        } else if (in_array('QC', $groups)) {
            $menu[] = ['text' => 'Sales', 'url' => '/sales'];
        }

        return view('profile')->with('menu', $menu);
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
        $userId = Input::get("uid");
        return $this->profileService->getPhoto($userId ? $userId : $this->userId);
    }

    public function cover() {
        return $this->profileService->getCover($this->userId);
    }

    public function myTeam() {
        return $this->profileService->getTeammates($this->userId);
    }

    public function findTopSeller() {
        $top3 = $this->saleRepo->findTopSeller();
        if ($top3) {
            $imInTop3 = false;
            foreach($top3 as $user) {
                if (Auth::user()->id == $user->user_id) {
                    $imInTop3 = true;
                    break;
                };
            }
            if (!$imInTop3) {
                $data = $this->saleRepo->findUserSpotAsSeller(Auth::user()->id);
                if (is_array($data) && count($data) == 1) {
                    $top3[] =$data[0];
                }
            }
        }
        return $top3;
    }
}
