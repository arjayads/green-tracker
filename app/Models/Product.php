<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function campaign()
    {
        return $this->belongsTo('app\Models\Campaign');
    }
}