<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/09/2018
 * Time: 19:27
 */

namespace watchers\controllers;


use watchers\models\Heros;
use watchers\models\Livre;
use watchers\models\Serie;
use watchers\vues\VueSearch;

class ControllerSearch
{
    /*
     * passe les donnée a un get pour facilter le rafraichisement de la page de recherche
     */
    public function rechercher(){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            $app = \Slim\Slim::getInstance();
            //on récupère le valeur transmise par l'utilisateur
            $content = $app->request()->post('search');
            //on redirige vers une page get
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('Search', ["content" => $content]));

        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     * affiche les comics ,serie ou heros qui on la chaine demandé dans leur nom ou titre
     */
    public function rechercherVue($content) {
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande les series qui contient la chaine envoyé
            $listeSerie = Serie::where("nom","like","%".$content."%")->get();
            //on demande les Heros qui contient la chaine envoyé
            $listeHeros = Heros::where("nom","like","%".$content."%")->get();
            //on demande les Livres qui contient la chaine envoyé
            $listeComics = Livre::where("titre","like","%".$content."%")->get();
            //on regroupe les resultat
            $param=Array("chianeSearch"=>$content,"listeSerie"=>$listeSerie,"listeHeros"=>$listeHeros,"listeComics"=>$listeComics);
            //on créer la vue & on l'affiche
            $vue=new VueSearch( $param);
            echo $vue->render(0);
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
    * affiche les heros qui on la chaine demandé dans leur nom ou titre
    * @param $content la chaine passé par le user
    */
    public function rechercherHeros($content) {
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande les Heros qui contient la chaine envoyé
            $listeHeros = Heros::where("nom","like","%".$content."%")->get();
            //on créer la vue & on l'affiche
            $param=Array("chianeSearch"=>$content,"listeHeros"=>$listeHeros);
            $vue=new VueSearch( $param);
            echo $vue->render(1);
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
    * affiche les heros qui on la chaine demandé dans leur nom ou titre
    * @param $content la chaine passé par le user
    */
    public function rechercherSeries($content) {
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande les series qui contient la chaine envoyé
            $listeSerie = Serie::where("nom","like","%".$content."%")->get();
            //on créer la vue & on l'affiche
            $param=Array("chianeSearch"=>$content,"listeSerie"=>$listeSerie);
            $vue=new VueSearch( $param);
            echo $vue->render(2);
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
    * affiche les heros qui on la chaine demandé dans leur nom ou titre
    * @param $content la chaine passé par le user
    */
    public function rechercherComics($content) {
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande les Livres qui contient la chaine envoyé
            $listeComics = Livre::where("titre","like","%".$content."%")->get();
            //on créer la vue & on l'affiche
            $param=Array("chianeSearch"=>$content,"listeComics"=>$listeComics);
            $vue=new VueSearch( $param);
            echo $vue->render(3);
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }

}