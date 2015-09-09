<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class ShiftRepo
{
    function findAll(array $fields = [])
    {
        if (count($fields))
        {
            return DB::table('shift')->select($fields)->get();
        }
        else
        {
            return DB::table('shift')->get();
        }
    }
}