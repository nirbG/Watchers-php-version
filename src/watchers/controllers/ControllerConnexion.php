<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/08/2018
 * Time: 23:23
 */

namespace watchers\controllers;


use watchers\utils\Authentification;
use watchers\vues\VueCompte;

class ControllerConnexion
{
    public function afficherConnexionFormulaire($erreur){
        $param= $this->erreur($erreur);
        $vue = new VueCompte($param);
        echo $vue->render(0);
    }

    public function seConnecter(){
        $app = \Slim\Slim::getInstance();
        $email = $app->request()->post('email');
        $mdp = $app->request()->post('password');
        $erreur=Authentification::authenticate($email,$mdp);
        //on test s'il y a une erreur
        if($erreur!=null) {
            //si oui on le redirige sur la meme page est on transmet l'idé de l'erreur
            $app->redirect($app->urlFor('formCo',['erreur'=>$erreur]));
        }
        //sinon on le redirige vers l'accueil
        $app->redirect($app->urlFor('accueil'));
        //$app->redirect($_SERVER["HTTP_REFERER"]);
    }



    /*
     * affiche le formulaire d'inscription
     */
    function formInsc($erreur){
        //on a ficche le formulaire avec l'erreur encontré a l'utilisateur
        $vue=new VueCompte(array(ControllerConnexion::erreur($erreur)));
        echo $vue->render(1);
    }

    /*
     * inscrit le client
     */
    function sinscrire(){
        $app = \Slim\Slim::getInstance();
        //on récupère les valeur du formulaire
        $email = $app->request()->post('email');
        $pass = $app->request()->post('password');
        $confirm = $app->request()->post('confirm');
        $pseudo= $app->request()->post('pseudo');
        //on crée le compte
        $erreur=Authentification::createUser($email,$pseudo,$pass,$confirm);
        //on test s'il y a une erreur
        if($erreur!=null){
            //si oui on le redirige vers la meme page et on lui transmet l'id de l'erreur rencontré
            $app->redirect($app->urlFor('formInsc',['erreur'=>$erreur]));
        }
        //sinon on le redirige pour qu'il se connecte
        $app->redirect($app->urlFor('formCo',['erreur'=>"input"]));

    }


    public function afficherInscriptionFormulaire(){
        $vue = new VueCompte();
        echo $vue->render(1);
    }

    public function afficherInscriptionFormulaireMail(){
        $vue = new VueCompte();
        echo $vue->render(4);
    }

    public function creerUtilisateur(){
        $app = \Slim\Slim::getInstance();
        $email = $app->request()->post('email');
        $login = $app->request()->post('pseudo');
        $mdp = $app->request()->post('password');
        $nom = $app->request()->post('prenom').' '.$app->request()->post('nom');

        $verif = $this->verifierInscription($login,$email);
        if($verif == true){
            //CREATION UTILISATEUR DANS BDD
            $utilisateur = new Utilisateur();
            $utilisateur->pseudo = $login;
            $utilisateur->mdp = password_hash($mdp,PASSWORD_DEFAULT);
            $utilisateur->adresseMail = $email;
            $utilisateur->nomReel = $nom;
            $utilisateur->image = "defaultIcon.png";
            $utilisateur->save();

            $_SESSION['idUser']=$utilisateur->id;

            return $verif;
        }else{
            $app->response()->redirect($app->urlFor('formInsc'));
            return $verif;
        }
    }

    public function verifierInscription($login,$email){
        $verif = true;
        $verifLogin = Utilisateur::where("pseudo","=",$login)->first();
        if($verifLogin != null){
            $verif = false;
        }else{
            $verifEmail = Utilisateur::where("adresseMail","=",$email)->first();
            if($verifEmail != null){
                $verif = false;
            }
        }
        return $verif;
    }


    /*
 * determine l'erreur rencontré
 */
    static function erreur($id){
        switch ($id){
            case '1':
                return "le compte n'existe pas";
                break;
            case '2':
                return 'ce compte existe deja';
                break;
            case '3':
                return "l'une ou plusieur de valeur saisi ne sont pas correct ou non rempli";
                break;
            case '4':
                return "le mot de passe saisi n'est pas correct";
                break;
            case '5':
                return "vous n'avez pas rempli les champs obligatoire ou il ne sont pas identique";
                break;
            case '6':
                return "le compte est deja utilisé";
                break;
            case 'input':
                return "";
                break;
        }
    }
}