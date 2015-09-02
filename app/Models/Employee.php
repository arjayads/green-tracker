<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'email',
        'password',
        'password_confirmation',
        'first_name',
        'last_name',
        'middle_name',
        'sex',
        'department_id',
        'position_id',
    ];

    public function user()
    {
        return $this->belongsTo('app\Models\User', 'user_id');
    }
}
