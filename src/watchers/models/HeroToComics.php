<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03/05/2018
 * Time: 17:38
 */

namespace watchers\models;


class HeroToComics extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'herotocomics';
    protected $primaryKey = 'idComics,idHeros';
    public $timestamps = false;
}