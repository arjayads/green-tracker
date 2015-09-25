<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/26/15
 * Time: 1:01 AM
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends  Model{
    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('app\Models\User');
    }
}