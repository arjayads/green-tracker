<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/23/15
 * Time: 1:28 AM
 */

namespace app\Dto;


use app\Models\Employee;

class EmployeeDto {

    function findById($id) {
        return Employee::with('user', 'shift')->find($id);
    }
}