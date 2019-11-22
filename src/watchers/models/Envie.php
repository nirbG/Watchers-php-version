<?php

namespace watchers\models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/11/2017
 * Time: 12:53
 */
class Envie extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'envie';
    protected $primaryKey = 'ISBN,idUser';
    public $timestamps = false;


}