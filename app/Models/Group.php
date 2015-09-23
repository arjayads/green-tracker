<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/24/15
 * Time: 3:30 AM
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'groups';
}