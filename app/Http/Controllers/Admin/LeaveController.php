<?php

namespace app\Http\Controllers\Admin;

use app\Http\Controllers\Controller;
use app\Models\LeaveApplication;
use app\Models\LeaveApplicationDetails;
use app\Repositories\LeaveRepo;

use app\ResponseEntity;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeaveController extends Controller
{
    public function __construct(LeaveRepo $leaveRepo) {
        $this->leaveRepo = $leaveRepo;

        parent::__construct();
    }

    public function index() {
        return view('admin.leave.index');
    }

    public function listByStatus($status = 'Pending') {
        return $this->leaveRepo->findALlByStatus($status);
    }

    function show($id) {
        $leave = $this->leaveRepo->findByIdAndEmployeeId($id);
        if ($leave) {
            $leave->dates = LeaveApplicationDetails::where('leave_application_id', $leave->id)->select(['date_from', 'date_to'])->orderBy('date_from', 'asc')->get();
            return view('admin.leave.show', ['leave' => $leave]);
        } else {
            throw new NotFoundHttpException();
        }
    }

    function process() {

        $params = Input::get();

        $response = new ResponseEntity();
        try {
            if ($params) {
                $leave = LeaveApplication::where('id', $params['id'])->where('status', 'Pending')->first();
                if ($leave) {
                    $leave->status = $params['status'];
                    $leave->save();

                    $response->setSuccess(true);
                    $response->setMessage('Leave application successfully processed!');
                } else {
                    $response->setMessage('Leave application is not available');
                }
            } else {
                $response->setMessage('Invalid parameters');
            }
        } catch (\Exception $ex) {
            $response->setMessages(['Exception: ' . $ex->getMessage()]);
        }
        return $response->toArray();
    }

}
