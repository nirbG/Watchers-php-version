<?php

namespace watchers\models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/11/2017
 * Time: 12:53
 *
 */

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Collection as colllection;

class Heros extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'héros';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function comics(){
        return $this->belongsToMany('watchers\models\Livre','heroToComics','idHeros','idComics');
    }
    public function series(){
        return $this->belongsToMany('watchers\models\Serie','herotoseries','idHeros','idSerie');
    }
    public function myHeros(){

        $userId=$_SESSION["profile"]["userid"];
        $query=<<<END
        SELECT *
        FROM `héros`
        WHERE `héros`.id IN(
            SELECT `heroToComics`.idHeros
            FROM `livre` INNER JOIN `heroToComics` ON `livre`.`ISBN`=`heroToComics`.idComics
            WHERE `livre`.ISBN IN(
                 SELECT ISBN
                 FROM `possède`
                 WHERE `idUser`=$userId
            )
             GROUP by `heroToComics`.idHeros
        )
END;
        /*
        $myHeros=Livre::selectRaw('idHeros')->join('heroToComics', 'livre.ISBN', '=', 'heroToComics.idComics')->whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser",$userId);
        })->groupBy("idHeros")->get();
*/
        $results = new colllection( DB::select( DB::raw($query)) );
        return $results;
    }
    public function MyherosStat(){
        $userId=$_SESSION["profile"]["userid"];
        $myHeros=Livre::selectRaw('idHeros ,count(*) as numberComics')->join('heroToComics', 'livre.ISBN', '=', 'heroToComics.idComics')->whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser",$userId);
        })->groupBy("idHeros")->orderby('numberComics','DESC')->get();
        return $myHeros;
    }

    public function myUnivserse(){

        $userId=$_SESSION["profile"]["userid"];
        $query=<<<END
SELECT `héros`.Univers,count(*)
        FROM `héros`
        WHERE `héros`.id IN(
            SELECT `heroToComics`.idHeros
            FROM `livre` INNER JOIN `heroToComics` ON `livre`.`ISBN`=`heroToComics`.idComics
            WHERE `livre`.ISBN IN(
                 SELECT ISBN
                 FROM `possède`
                 WHERE `idUser`=$userId
            )
            
        )
        GROUP by `héros`.Univers
END;
        /*
        $myHeros=Livre::selectRaw('idHeros')->join('heroToComics', 'livre.ISBN', '=', 'heroToComics.idComics')->whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser",$userId);
        })->groupBy("idHeros")->get();
*/
        $results = new colllection( DB::select( DB::raw($query)) );
        return $results;
    }

    public function myAllie($id){

        //SELECT * from `livre` where `ISBN` IN(SELECT ISBN FROM `envie` WHERE `idUser`=3)
        $myAllie=Heros::whereIn("id",function ($query) use($id){
            $query->select("allie")->from((new Allie)->getTable())->where("heros",$id);
        })->get();
        return $myAllie;
    }
    public function myEnemi($id){
        //SELECT * from `livre` where `ISBN` IN(SELECT ISBN FROM `envie` WHERE `idUser`=3)
        $myEnemi=Heros::whereIn("id",function ($query) use($id){
            $query->select("enemi")->from((new Enemi)->getTable())->where("heros",$id);
        })->get();
        return $myEnemi;
    }
    public function myTeam($id){
        //SELECT * from `livre` where `ISBN` IN(SELECT ISBN FROM `envie` WHERE `idUser`=3)
        $myEnemi=Heros::whereIn("id",function ($query) use($id){
            $query->select("equipe")->from((new Equipe)->getTable())->where("heros",$id);
        })->get();
        return $myEnemi;
    }
    public function herosToBooks($idHeros){
        //SELECT * from `livre` where `ISBN` IN(SELECT idComics FROM `serietocomics` WHERE `id`=f)

        $myBooks=Livre::selectRaw('*')->whereIn("ISBN",function ($query) use($idHeros){
            $query->select("idComics")->from((new HeroToComics)->getTable())->where("idHeros",$idHeros);
        })->orderBy('date')->get();
        return $myBooks;
        // return Possede::where("idUser","=",$_SESSION["profile"]["userid"])->orderBy("dateAjout","desc")->get();
    }

    public function ComicsToHero($idCo){
        //SELECT * from `livre` where `ISBN` IN(SELECT idComics FROM `serietocomics` WHERE `id`=f)

        $myBooks=Heros::selectRaw('*')->whereIn("id",function ($query) use($idCo){
            $query->select("idHeros")->from((new HeroToComics)->getTable())->where("idComics",$idCo);
        })->get();
        return $myBooks;
        // return Possede::where("idUser","=",$_SESSION["profile"]["userid"])->orderBy("dateAjout","desc")->get();
    }

    public function herosToSerie($idHeros){
        //SELECT * from `livre` where `ISBN` IN(SELECT idComics FROM `serietocomics` WHERE `id`=f)

        $myBooks=Serie::selectRaw('*')->whereIn("id",function ($query) use($idHeros){
            $query->select("idSerie")->from((new HeroToSerie)->getTable())->where("idHeros",$idHeros);
        })->get();
        return $myBooks;
        // return Possede::where("idUser","=",$_SESSION["profile"]["userid"])->orderBy("dateAjout","desc")->get();
    }
}