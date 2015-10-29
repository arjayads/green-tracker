<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/23/15
 * Time: 4:20 AM
 */

namespace app\Repositories;


use Illuminate\Support\Facades\DB;

class UserRepo {

    function findDefaultUrl($userId)
    {
        $q = DB::table('users')
            ->join('user_groups', 'users.id', '=', 'user_groups.user_id')
            ->join('groups', 'user_groups.group_id', '=', 'groups.id');
        return $q->where('user_groups.user_id', '=', $userId)->lists('default_url');
    }

    function findEmployee($userId)
    {
        $q = DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id');
        return $q->where('user_id', '=', $userId)->first();
    }

    function findGroups($userId)
    {
        $q = DB::table('users')
            ->join('user_groups', 'users.id', '=', 'user_groups.user_id')
            ->join('groups', 'user_groups.group_id', '=', 'groups.id');
        return $q->where('user_groups.user_id', '=', $userId)->lists('name');
    }
}