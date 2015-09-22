<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProcessed extends Model
{
    protected $table = 'sales_processed';

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

    public function qualityController()
    {
        return $this->belongsTo('app\Models\User', 'qc_user_id');
    }

    public function status()
    {
        return $this->belongsTo('app\Models\SaleStatus', 'sale_status_id');
    }
}