<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

    public function products()
    {
        return $this->hasMany('app\Models\Product');
    }
}