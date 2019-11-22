<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26/09/2018
 * Time: 14:22
 */

namespace watchers\models;


class SerieToComics extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'serietocomics';
    protected $primaryKey = 'idSerie,idComics';
    public $timestamps = false;
}