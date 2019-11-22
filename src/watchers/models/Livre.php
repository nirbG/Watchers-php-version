<?php

namespace watchers\models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/11/2017
 * Time: 12:53
 */
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Collection as colllection;
use function MongoDB\BSON\toJSON;

class Livre extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'livre';
    protected $primaryKey = 'ISBN';
    public $timestamps = false;

    function  isEnvie(){
        $res=true;
        $env=Envie::where(["ISBN"=>$this->ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->count();
        if($env<1){
            $res=false;
        }
        return $res;
    }

    function  isPrixAchat(){
        $pos=Possede::where(["ISBN"=>$this->ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->first();
        if($pos==null){
            return null;
        }
        return $pos->prix;
    }
    function  isPossede(){
        $res=true;
        $env=Possede::where(["ISBN"=>$this->ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->count();
        if($env<1){
            $res=false;
        }
        return $res;
    }

    function isLieeBySerie($idh){
        $res=false;
        $serie = SerieToComics::where("idComics", "=", $this->ISBN)->first();
        if ($serie != null) {
            $hs = HeroToSerie::where(["idHeros" => $idh, "idSerie" => $serie->idSerie])->first();
            if ($hs == null) {

                $res=true;
            }
        } else {
            $res=true;
        }
        return $res;

    }

    public function heros(){
        return $this->belongsToMany('watchers\models\Heros','heroToComics','idComics','idHeros');

    }
    public function serie(){
        return $this->belongsToMany('watchers\models\Serie','serietocomics','idComics','idSerie');
    }

    public function myBooks()
    {
        //SELECT * from `livre` where `ISBN` IN(SELECT ISBN FROM `possède` WHERE `idUser`=3)
        $userId = $_SESSION["profile"]["userid"];
        $myBooks = Livre::selectRaw('*')->whereIn("ISBN", function ($query) use ($userId) {
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser", $userId)->orderby("dateAjout", "desc");
        })->get();
        return $myBooks;
        // return Possede::where("idUser","=",$_SESSION["profile"]["userid"])->orderBy("dateAjout","desc")->get();
    }

    public function myBooksThisYear(){
        //SELECT * from `livre` where `ISBN` IN(SELECT ISBN FROM `possède` WHERE `idUser`=3)
        $userId=$_SESSION["profile"]["userid"];
        $prix=Possede::where("idUser",$userId)->whereYear('dateAjout', '=',date("Y"))->get()->sum("prix");
        /*$myBooks=Livre::selectRaw('*')->whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser",$userId)->whereYear('dateAjout', '=',date("Y"));
        })->get();*/
        return $prix;
        // return Possede::where("idUser","=",$_SESSION["profile"]["userid"])->orderBy("dateAjout","desc")->get();
    }


    public function mySeries(){
        //SELECT `série`.nom,`série`.nblivre,`livre`.serie,count(*)
        // FROM `livre` INNER JOIN `série` ON `livre`.`serie`=`série`.id
        // WHERE `livre`.ISBN IN(
        //  SELECT ISBN
        //  FROM `possède`
        //  WHERE `idUser`=3
        //)
        //GROUP by `livre`.serie
        $userId=$_SESSION["profile"]["userid"];
        $MySeries=Livre::selectRaw('nom,nblivre,serie,count(*) as numberComics')->join('série', 'livre.serie', '=', 'série.id')->whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser",$userId);
        })->groupBy("serie")->get();
        return $MySeries;
    }

    public function mySeriesnumber($id){

        //SELECT `série`.nom,`série`.nblivre,`livre`.serie,count(*)
        // FROM `livre` INNER JOIN `série` ON `livre`.`serie`=`série`.id
        // WHERE `livre`.ISBN IN(
        //  SELECT ISBN
        //  FROM `possède`
        //  WHERE `idUser`=3
        //)
        //GROUP by `livre`.serie
        $userId=$_SESSION["profile"]["userid"];
        $MySeries=Livre::selectRaw('nom,nblivre,serie,count(*) as numberComics')->join('série', 'livre.serie', '=', 'série.id')->whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser",$userId);
        })->where("id","=",$id)->groupBy("serie")->count();
        return $MySeries;
    }


    public function myEnvie(){
        //SELECT * from `livre` where `ISBN` IN(SELECT ISBN FROM `envie` WHERE `idUser`=3)
        $userId=$_SESSION["profile"]["userid"];
        $myEnvie=Livre::whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Envie)->getTable())->where("idUser",$userId);
        })->get();
        return $myEnvie;
    }
    public function nbEnvie(){
        //SELECT * from `livre` where `ISBN` IN(SELECT ISBN FROM `envie` WHERE `idUser`=3)
        $userId=$_SESSION["profile"]["userid"];
        return Envie::where("idUser",$userId)->get()->count();
    }

    public function SerieLesPLuslongue($nbS){
        $userId=$_SESSION["profile"]["userid"];
       $res=Livre::selectRaw('nom,nblivre,serie,série.nom as sNom,count(*) as numberComics')->join('série', 'livre.serie', '=', 'série.id')->whereIn("ISBN",function ($query) use($userId){
            $query->select("ISBN")->from((new Possede)->getTable())->where("idUser",$userId);
        })->groupBy("serie")->orderBy("numberComics","DESC")->get()->take($nbS);
        return $res;
    }

    public function commentaire(){
        return Commentaire::where("isbn" ,"=",$this->ISBN)->orderby("date")->get();
    }



}