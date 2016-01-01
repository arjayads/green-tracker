<?php

namespace app\Http\Controllers;

use app\Models\LeaveApplication;
use app\Models\LeaveApplicationDetails;
use app\Models\LeaveType;
use app\Repositories\LeaveRepo;
use app\ResponseEntity;
use Carbon\Carbon;

use app\Http\Requests;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeaveController extends Controller
{
    public function __construct(LeaveRepo $leaveRepo) {
        $this->leaveRepo = $leaveRepo;

        parent::__construct();
    }

    public function index() {
        return view('employee.index-leave');
    }

    public function apply() {
        return view('employee.apply-leave');
    }

    public function myList($status = 'Pending') {
        return $this->leaveRepo->findALlByStatus($status, $this->employeeId);
    }

    public function types() {
        return LeaveType::all();
    }

    public function create(Requests\ApplyForLeaveRequest $request) {
        $params = $request->all();

        $response = new ResponseEntity();
        try {
            DB::transaction(function() use (&$response, $params)
            {
                $application = new LeaveApplication();
                $application->purpose = $params['purpose'];
                $application->no_of_days = $params['no_of_days'];
                $application->leave_type_id = $params['leave_type_id'];
                $application->employee_id = $this->employeeId;
                $application->date_filed = Carbon::now()->toDateString();
                $application->created_by_user_id = $this->userId;

                $a = $application->save();
                if($a) {

                    $dates = $params['dates'];
                    if (is_array($dates) && count($dates) > 0) {
                        foreach($dates as $d) {
                            // e.g. : 01/26/2016 - 01/26/2016
                            $dArr =  explode(' - ', $d);
                            $lad = new LeaveApplicationDetails();
                            $lad->date_from = Carbon::createFromFormat('m/d/Y', $dArr[0])->toDateString();
                            $lad->date_to = Carbon::createFromFormat('m/d/Y', $dArr[1])->toDateString();
                            $lad->leave_application_id = $application->id;
                            $lad->save();
                        }
                    }
                    $response->setMessages(['Leave application successfully saved!']);
                    $response->setSuccess(true);
                } else {
                    $response->setMessages(['Failed to process leave application!']);
                }
            });
        }
        catch (\Exception $ex)
        {
            $response->setMessages(['Exception: ' . $ex->getMessage()]);
        }
        return $response->toArray();
    }

    function show($id) {
        $leave = $this->leaveRepo->findByIdAndEmployeeId($id, $this->employeeId);
        if ($leave) {
            $leave->dates = LeaveApplicationDetails::where('leave_application_id', $leave->id)->select(['date_from', 'date_to'])->orderBy('date_from', 'asc')->get();
            return view('employee.show-leave', ['leave' => $leave]);
        } else {
            throw new NotFoundHttpException();
        }
    }

    function cancel($id) {

        $response = new ResponseEntity();
        try {
            $leave = LeaveApplication::where('id', $id)->where('employee_id', $this->employeeId)->where('status', 'Pending')->first();
            if ($leave) {
                $leave->status = 'Cancelled';
                $leave->save();

                $response->setSuccess(true);
                $response->setMessage('Leave application successfully cancelled!');
            }
            else
            {
                $response->setMessage('Leave application is not available');
            }
        } catch (\Exception $ex) {
            $response->setMessages(['Exception: ' . $ex->getMessage()]);
        }
        return $response->toArray();
    }
}
