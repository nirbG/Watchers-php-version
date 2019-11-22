<?php

namespace watchers\models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/11/2017
 * Time: 12:53
 */
class Commentaire extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'commentaire';
    protected $primaryKey = 'id,isbn';
    public $timestamps = false;

}