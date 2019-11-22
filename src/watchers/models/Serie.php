<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05/05/2018
 * Time: 20:44
 */

namespace watchers\models;


class Serie extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'série';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function comics(){
        return $this->belongsToMany('watchers\models\Livre','serietocomics','idSerie','idComics');
    }
    public function Heros(){
        return $this->belongsToMany('watchers\models\Heros','herotoseries','idSerie','idHeros');
    }

    public function serieToBooks($idSerie){
        //SELECT * from `livre` where `ISBN` IN(SELECT idComics FROM `serietocomics` WHERE `id`=f)

        $myBooks=Livre::selectRaw('*')->whereIn("ISBN",function ($query) use($idSerie){
            $query->select("idComics")->from((new SerieToComics)->getTable())->where("idSerie",$idSerie);
        })->get();
        return $myBooks;
        // return Possede::where("idUser","=",$_SESSION["profile"]["userid"])->orderBy("dateAjout","desc")->get();
    }

    public function serieBooks(){
        //SELECT * from `livre` where `ISBN` IN(SELECT idComics FROM `serietocomics` WHERE `id`=f)
        $idSerie="";
        $myBooks=Livre::selectRaw('*')->whereIn("ISBN",function ($query) use($idSerie){
            $query->select("idComics")->from((new SerieToComics)->getTable());
        })->get();
        return $myBooks;
        // return Possede::where("idUser","=",$_SESSION["profile"]["userid"])->orderBy("dateAjout","desc")->get();
    }

    public function nbSorteParAns($date){

    }


}