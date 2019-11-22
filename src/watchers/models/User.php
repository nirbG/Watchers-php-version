<?php

namespace watchers\models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/11/2017
 * Time: 12:53
 */
class User extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo('\watchers\models\Role','role_id');
    }


}