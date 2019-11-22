<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03/05/2018
 * Time: 17:38
 */

namespace watchers\models;


class HeroToSerie extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'herotoseries';
    protected $primaryKey = 'idSerie,idHeros';
    public $timestamps = false;
}