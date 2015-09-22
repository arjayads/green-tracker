<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';

    protected $fillable = ['description', 'log_in', 'log_out', 'start_date', 'end_date'];

    public function employee()
    {
        return $this->hasMany('app\Models\Employee', 'shift_id');
    }
}
