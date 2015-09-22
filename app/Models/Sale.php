<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    public function product()
    {
        return $this->belongsTo('app\Models\Product');
    }

    public function customer()
    {
        return $this->belongsTo('app\Models\Customer');
    }

    public function processedBy()
    {
        return $this->belongsTo('app\Models\User', 'user_id');
    }
}