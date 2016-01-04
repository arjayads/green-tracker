<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 10/7/15
 * Time: 3:06 AM
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model {

    protected $table = 'leave_applications';

    protected $fillable = [
        'purpose',
        'employee_id',
        'date_filed',
        'no_of_dayes',
        'created_by_user_id',
        'approved1_by_user_id',
        'approved2_by_user_id',
        'leave_type_id',
        'status',
        'date_processed1',
        'date_processed2'
    ];
}