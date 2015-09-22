<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class ShiftRepo
{
    function findAll(array $fields = [])
    {
        if (count($fields))
        {
            return DB::table('shifts')->select($fields)->get();
        }
        else
        {
            return DB::table('shifts')->get();
        }
    }
}