<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 10/7/15
 * Time: 3:06 AM
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class LeaveType  extends Model {

    protected $table = 'leave_types';

    public $timestamp = false;
}