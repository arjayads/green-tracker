<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;
use app\Repositories\ShiftRepo;

class ShiftController extends Controller
{
    private $shiftRepo;

    public function __construct()
    {
        $this->shiftRepo = new ShiftRepo();
    }

    public function shiftList()
    {
        return $this->shiftRepo->findAll(['id', 'description']);
    }
}
