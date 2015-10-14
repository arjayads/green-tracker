<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/24/15
 * Time: 3:30 AM
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {

    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'user_groups';

    public function user()
    {
        return $this->belongsTo('app\Models\User', 'user_id');
    }

    public function group()
    {
        return $this->belongsTo('app\Models\Group', 'group_id');
    }
}