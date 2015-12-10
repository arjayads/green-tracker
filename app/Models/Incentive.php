<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    protected $table = 'incentives';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'date',
        'sale_count',
        'multiplier',
        'last_name',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo('app\Models\User', 'user_id');
    }
}
