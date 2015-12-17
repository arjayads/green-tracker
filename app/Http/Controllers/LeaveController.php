<?php

namespace app\Http\Controllers;

use app\Models\LeaveApplication;
use app\Models\LeaveApplicationDetails;
use app\Models\LeaveType;
use app\ResponseEntity;
use Carbon\Carbon;
use Illuminate\Http\Request;

use app\Http\Requests;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function apply() {
        return view('employee.apply-leave');
    }

    public function types() {
        return  LeaveType::all();
    }

    public function create(Request $request) {
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
