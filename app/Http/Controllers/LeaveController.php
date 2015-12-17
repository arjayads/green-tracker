<?php

namespace app\Http\Controllers;

use app\Models\LeaveApplication;
use app\Models\LeaveApplicationDetails;
use app\Models\LeaveType;
use app\ResponseEntity;
use Carbon\Carbon;

use app\Http\Requests;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return view('employee.index-leave');
    }

    public function apply() {
        return view('employee.apply-leave');
    }

    public function myList($status = 'Pending') {
        $q = DB::table('leave_applications')
            ->join('leave_application_details', 'leave_applications.id', '=', 'leave_application_details.leave_application_id')
            ->join('leave_types', 'leave_applications.leave_type_id', '=', 'leave_types.id')

            ->where('status', $status);

        return $q->select(
            'leave_applications.id',
            'leave_applications.purpose',
            'leave_types.description as leave_type',
            'leave_applications.status',
            'leave_applications.no_of_days',
            'leave_applications.date_filed',
            DB::raw('GROUP_CONCAT(leave_application_details.date ORDER BY leave_application_details.date) as dates')
        )
            ->groupBy('leave_applications.id')
            ->get();
    }

    public function types() {
        return  LeaveType::all();
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
                            $lad = new LeaveApplicationDetails();
                            $lad->date = Carbon::createFromFormat('m/d/Y', $d)->toDateString();
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
}
