<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/23/15
 * Time: 4:20 AM
 */

namespace app\Repositories;


use app\Models\LeaveApplicationDetails;
use Illuminate\Support\Facades\DB;

class LeaveRepo {

    function  findByIdAndEmployeeId($id, $employeeId = null) {
        $q = DB::table('leave_applications')
            ->join('leave_types', 'leave_applications.leave_type_id', '=', 'leave_types.id')
            ->where('leave_applications.id', $id);

        if ($employeeId != null) {
            $q->where('employee_id', $employeeId);
        }

        return $q->select(
            'leave_applications.id',
            'leave_applications.purpose',
            'leave_types.description as leave_type',
            'leave_applications.status',
            'leave_applications.no_of_days',
            'leave_applications.date_filed'
        )
            ->first();
    }

    function findALlByStatus($status = 'Pending', $employeeId = null) {
        $q = DB::table('leave_applications')
            ->join('leave_types', 'leave_applications.leave_type_id', '=', 'leave_types.id')
            ->where('status', $status);

        if ($employeeId != null) {
            $q->where('employee_id', $employeeId);
        }

        $leaves = $q->select(
            'leave_applications.id',
            'leave_applications.purpose',
            'leave_types.description as leave_type',
            'leave_applications.status',
            'leave_applications.no_of_days',
            'leave_applications.date_filed'
        )
            ->get();

        if (is_array($leaves) && count($leaves) > 0) {
            foreach($leaves as &$leave) {
                $leave->dates = LeaveApplicationDetails::where('leave_application_id', $leave->id)->select(['date_from', 'date_to'])->orderBy('date_from', 'asc')->get();
            }
        }

        return $leaves;
    }
}