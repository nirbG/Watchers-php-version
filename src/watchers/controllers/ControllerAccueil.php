<?php

/**
 * Created by PhpStorm.
 * User: Benoît
 * Date: 15/05/2018
 * Time: 11:23
 */

namespace watchers\controllers;



use watchers\models\Heros;
use watchers\models\Livre;
use watchers\models\Possede;
use watchers\models\Serie;
use watchers\models\User;
use watchers\models\Wallpaper;
use watchers\vues\VueAccueil;
use watchers\vues\VueBd;

class ControllerAccueil {

    /*
     * on affiche la page d'accueil
     */
    public function afficherAccueil() {
        //on compte le nombre de wallpaper
        $nbW=Wallpaper::count();
        //on en demande un
        $w=Wallpaper::where('id','=',rand ( 1 ,$nbW-1 ))->first();
        //on crée la vue
        $vue = new VueAccueil($w);
        //on affiche la page
        echo $vue->render(0);
    }

    /*
     * on affcihe la page d'accueil d'un user connecter
     */
    public function afficherAccueilConnecte() {
        //on test si le user est connecter
        $app=\Slim\Slim::getInstance();
        if(!isset($_SESSION["profile"])){
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->response()->redirect($app->urlFor('accueil'));
        }
        $livre=new Livre();
        //on recupère les info de l'utilisateur
        $user=User::where("id","=",$_SESSION["profile"]["userid"])->first();
        //on récupère les dernier comics ajouter par l'utilisateur
        $lastAdd=$livre->myBooks()->reverse()->take(6);
        //on récupère les comics de l'utilisateur
        $possede=$livre->myBooks();

        //on effectue des stats pour les graphs
        $myS = $livre->mySeries();
        $nblivre=0;
        $nblivrepossede=0;
        $nbSerieTerm=0;
        $nbSerieNonTerm=0;
        $depense=0;
        $coutParDefaut=0;
        $manquant=0;
        foreach ($myS as $s){
            $nblivrepossede+=$s->numberComics;
            $nblivre+=$s->nblivre;
            $ser=new Serie();
            foreach ($ser->serieToBooks($s->serie) as $serBook){
                $prix=$serBook->isPrixAchat();
                if($prix!=null){
                    $coutParDefaut+=$serBook->prix;
                    $depense+=$prix;
                }else{
                    $manquant+=$serBook->prix;
                }
            }
            if($s->nblivre==$s->numberComics){
                $nbSerieTerm++;
            }else{
                $nbSerieNonTerm++;
            }
        }

        //on prepare les info pour la courbe des achat des derniers mois
        $i=0;
        $year=date("Y");
        $month=date("m");
        $Chart1=array();
        while($i<5){
            $Chart1[$i]=array(
                "month"=>"$month", "year"=>$year,"nbl"=>Possede::where("idUser","=",$user->id)->whereMonth('dateAjout', '=', $month)->whereYear('dateAjout', '=', $year)->get()->count());
            if($month==1){
                $month=12;
                $year--;
            }else{
                $month--;
            }
            $i++;
        }


        $heros=new Heros();
        $UniverseChart=$heros->myUnivserse();

        $MyherosStat=$heros->MyherosStat();
        $MyherosStat=$MyherosStat->take(5);
        $Chart3=array();
        $i=0;
       foreach ($MyherosStat as $herosStat){
            $Chart3[$i]=array("heros"=>Heros::where("id","=",$herosStat->idHeros)->first(),"nbl"=>$herosStat->numberComics);
            $i++;
        }
        //on initialise les donnée a donner a la vue
        $param=array("nbSerieTerm"=>$nbSerieTerm,               "nbSerieNonTerm"=>$nbSerieNonTerm,
                    "booksSerieTotal"=>$nblivre-$nblivrepossede,"booksSerie"=>$nblivrepossede,
                    "pseudo"=>$user->pseudo,"user"=>$user,      "date"=>$user->dateCreation,
                    "nblivre"=>$possede->count(),               "chart 1"=>$Chart1,
                    "chart 2"=>$UniverseChart,                  "chart 3"=>$Chart3,
                    "lastAjout"=>$lastAdd,                      "depense"=>$depense,
                    "manquant"=>$manquant,                      "difference"=>$depense-$coutParDefaut,
                    "depenseCetteA"=>round($livre->myBooksThisYear()/12,2),
                    "envie"=>$livre->myEnvie()                  ,"chart 5"=>$livre->SerieLesPLuslongue(6));
        //on créer la vue et on l'affiche
        $vue=new VueBd($param);
        echo $vue->render(0);
    }



}
