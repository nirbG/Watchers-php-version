<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/09/2018
 * Time: 21:42
 */

namespace watchers\controllers;


use watchers\models\Allie;
use watchers\models\Enemi;
use watchers\models\Envie;
use watchers\models\Heros;
use watchers\models\HeroToComics;
use watchers\models\HeroToSerie;
use watchers\models\Livre;
use watchers\models\Possede;
use watchers\models\Serie;
use watchers\models\SerieToComics;
use watchers\vues\VueAdmin;

class ControllerAdmin
{

    /*
     * affiche la page d'accueil de la partie admin
     */
    public function adminHome(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if($_SESSION["profile"]["role_id"]==2){
                //on créer la vue & on l'affiche
                $vue=new VueAdmin();
                echo $vue->render(0);
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }

    }

    /*
     * affiche la liste des heros
     */
    public function listHeros(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if($_SESSION["profile"]["role_id"]==2){
                //on recupère tous les heros
                $heros=Heros::all();
                //on créer la vue & on l'affiche
                $vue=new VueAdmin($heros);
                echo $vue->render(1);
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * affiche la liste des serie du site
     */
    public function listSerie(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if($_SESSION["profile"]["role_id"]==2){
                //on recupère tous les Serei
                $serie=Serie::all();
                //on créer la vue & on l'affiche
                $vue=new VueAdmin($serie);
                echo $vue->render(2);
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * affiche la liste des comics du site
     */
    public function listComics(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if($_SESSION["profile"]["role_id"]==2){
                //on recupère tous les Comics
                $comics=Livre::all();
                //on créer la vue & on l'affiche
                $vue=new VueAdmin($comics);
                echo $vue->render(3);
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * affiche la page de mod d'un comics
     * @param isbn(code d'identification d'un livre)
     */
    public function livreMOD($ISBN){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if($_SESSION["profile"]["role_id"]==2){
                //on recupère le livre
                $comics=Livre::where("ISBN","=",$ISBN)->first();
                $h=new Heros();
                $heros=$h->ComicsToHero($ISBN);
                //on créer la vue & on l'affiche
                $vue=new VueAdmin(array($comics,$heros));
                echo $vue->render(4);
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * modifier le comics
     * @param isbn(code d'identification d'un livre)
     */
    public function updatelivre($ISBN){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                //on récupère le livre
                $livre = Livre::where("ISBN", '=', $ISBN)->first();
                //on récupère les valeurs transmise
                $ISBN = $app->request()->post('ISBN');
                $EAN = $app->request()->post('EAN');
                $titre = $app->request()->post('titre');
                //si c'est null on ne le modifie pas
                if($ISBN!=null) {
                    $livre->ISBN = $ISBN;
                }
                if($EAN!=null) {
                    $livre->EAN = $EAN;
                }
                if($titre!=null) {
                    $livre->titre = $titre;
                }
                $this->downloadModImG("theme/ressources/livre/",$_FILES["img"],$ISBN);
                $livre->date=$app->request()->post('date');
                //on sauvegarde les nouvelles valeurs
                $livre->save();
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('livreMOD',["ISBN"=>$ISBN]));
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }

    }

    /*
     * affiche la page de mod d'une serie
     * @param id(code d'identification d'une serie)
     */
    public function serieMOD($id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if($_SESSION["profile"]["role_id"]==2){
                //on recupère tous les heros
                $serie=Serie::where("id","=",$id)->first();
                $serieModel=new Serie();
                $comics=$serieModel->serieToBooks($id);
                //on créer la vue & on l'affiche
                $vue=new VueAdmin(["serie"=>$serie,"comics"=>$comics]);
                echo $vue->render(5);
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * modifier la serie
     * @param id(code d'identification d'une serie)
     */
    public function updateSerie($id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $livre = Serie::where("id", '=', $id)->first();
                $nom = $app->request()->post('nom');
                if($nom!=null) {
                    $livre->nom= $nom;
                }
                $livre->save();
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('serieMOD',["id"=>$id]));
            }
        }

    }

    /*
     * affiche la page de mod d'un hero
     * @param id(code d'identification d'un hero)
     */
    public function heroMOD($id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if($_SESSION["profile"]["role_id"]==2){
                //on recupère tous les heros
                $hero=Heros::where("id","=",$id)->first();
                $heroModel=new Heros();
                $comics=$heroModel->herosToBooks($hero->id);
                $series=$heroModel->herosToSerie($hero->id);
                //on créer la vue & on l'affiche
                $vue=new VueAdmin(["hero"=>$hero,"series"=>$series,"comics"=>$comics]);
                echo $vue->render(6);
            }else{
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('accueil'));
            }
        }else{
            // on rediriger vers la page d'accueil su site
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * modifier le hero
     * @param id(code d'identification d'une hero)
     */
    public function updateHero($id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $hero = Heros::where("id", '=', $id)->first();
                $nom = $app->request()->post('nom');
                $univers = $app->request()->post('Univers');
                if ($nom != null) {
                    $hero->nom = $nom;
                }
                $hero->desc = $app->request()->post('desc');
                $hero->Pouvoir = $app->request()->post('Pouvoir');
                if ($univers != null) {
                    $hero->Univers = $univers;
                }
                $this->downloadModImG("theme/ressources/heros/",$_FILES["img"],"heros".$hero->id);
                $this->downloadModImG("theme/ressources/logo/",$_FILES["logo"],"logo".$hero->id);
                $hero->save();
                //on redirige vers la page d'accueil compte
                $app->redirect($app->urlFor('heroMOD', ["id" => $id]));
            }
        }
    }

    /*
     * affiche le formulaire pour crée un heros
     */
    function newHero(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $vue=new VueAdmin();
                echo $vue->render(7);
            }
        }
    }

    /*
     * créer le heros dans la base
     */
    function addHero(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                //on créer le héros
                $hero = new Heros();
                //on récupère le nom et on verifie le nom saisi
                $nom = $app->request()->post('nom');
                if (ctype_space($nom) || $nom === "" || $nom === null) {
                    $app->redirect($app->urlFor('newHero'));
                }
                //on rempli les attribut
                $hero->nom = $nom;
                $hero->desc = $app->request()->post('desc');
                $hero->Pouvoir = $app->request()->post('Pouvoir');
                $hero->Univers = $app->request()->post('Univers');
                //on save
                $hero->save();
                //puis on telecharge les photos
                $this->downloadImG("theme/ressources/heros/",$_FILES["img"],"heros".$hero->id);
                $this->downloadImG("theme/ressources/logo/",$_FILES["logo"],"logo".$hero->id);
                // puis on rempli les attribut liée au image
                $hero->img="heros".$hero->id.".jpg";
                $hero->Logo="logo".$hero->id.".png";
                //et on save
                $hero->save();
                //on redirige vers la page de mod du héros
                $app->redirect($app->urlFor('heroMOD', ["id" => $hero->id]));
            }
        }
    }

    /*
     * on affiche le formulaire pour créer une série
     */
    function newSerie(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $vue=new VueAdmin();
                echo $vue->render(8);
            }
        }
    }

    /*
     * on ajoute la serie dans la base
     */
    function addSerie(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                // on créer la serie
                $serie = new Serie();
                //on recupère les données
                //on verifie le nom
                $nom = $app->request()->post('nom');
                if (ctype_space($nom) || $nom === "" || $nom === null) {
                    $app->redirect($app->urlFor('newSerie'));
                }
                $serie->nom=$nom;
                //on save
                $serie->save();
                //on redirige vers la page de mod de la serie
                $app->redirect($app->urlFor('serieMOD', ["id" => $serie->id]));
            }
        }
    }

    /*
     * on affiche le formulaire pour créer un Comics
     */
    function newComics(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $vue=new VueAdmin();
                echo $vue->render(9);
            }
        }
    }

    /*
     * on ajoute le comics
     */
    function addComics(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                //On créer le comics
                $comics = new Livre();
                //on récupère les post
                $ISBN = $app->request()->post('ISBN');
                $EAN = $app->request()->post('EAN');
                $titre = $app->request()->post('titre');
                //on rempli les attributs
                if (ctype_space($ISBN) || $ISBN === "" || $ISBN === null) {
                    $app->redirect($app->urlFor('newComics'));
                }
                $comics->ISBN=$ISBN;
                if (ctype_space($EAN) || $EAN === "" || $EAN === null) {
                    $app->redirect($app->urlFor('newComics'));
                }
                $comics->EAN=$EAN;
                if (ctype_space($titre) || $titre === "" || $titre === null) {
                    $app->redirect($app->urlFor('newComics'));
                }
                $comics->titre=$titre;
                $comics->Format=$app->request()->post('format');
                $comics->Editeur=$app->request()->post('editeur');
                $comics->date=$app->request()->post('date');
                //on télécharge l'image
                $this->downloadImG("theme/ressources/livre/",$_FILES["img"],$comics->ISBN);
                $comics->img=$comics->ISBN.".jpg";
                //on save
                $comics->save();
                //on redirige vers la page de mod du livre
                $app->redirect($app->urlFor('livreMOD', ["ISBN" => $ISBN]));
            }
        }
    }

    /*
     * on ajoute un comics a une serie
     */
    function addComics2Serie(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                //on crée la le lien
                $serie2Comics=new SerieToComics();
                $serie2Comics->idSerie= $_POST["idSerie"];
                $serie2Comics->idComics=$_POST["idComics"];
                $serie2Comics->save();

                //on modifie les info de la serie
                $s=Serie::where("id","=",$serie2Comics->idSerie)->first();
                $s->nblivre++;//on incremente le nb de livre
                $s->save();

                //on modifie la serie du comics
                $c=Livre::where('ISBN','=',$_POST["idComics"])->first();
                $c->serie=$_POST["idSerie"];
                $c->save();

                // on modifie les lien qui on besoin d'etre mis a jour
                $heros=$s->Heros()->get();
                foreach( $heros as $h){
                    //on lie le comics au heros qui sont liée a la série.
                    $hero2Comics=new HeroToComics();
                    $hero2Comics->idHeros= $h->id;
                    $hero2Comics->idComics=$_POST["idComics"];
                    $hero2Comics->save();
                }
            }
        }
    }

    /*
     * on supprime un comics d'une serie
     */
    function suppComics2Serie(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                echo $_POST["idSerie"]." ".$_POST["idComics"];
                //on récupère l'element voulu
                $s2C=SerieToComics::where(["idSerie"=>$_POST["idSerie"],"idComics"=>$_POST["idComics"]]);
                //on le supprime
                $s2C->delete();
                //on modifie la série
                $s=Serie::where("id","=",$_POST["idSerie"])->first();
                $s->nblivre--;//on decremente le nb de livre
                $s->save();
                //on mes a jour les base lié a la serie
                $c=Livre::where("ISBN","=",$_POST["idComics"])->first();
                $heros=$c->heros()->get();
                //on modifie la serie du comics
                $c=Livre::where('ISBN','=',$_POST["idComics"])->first();
                $c->serie=-1;
                $c->save();
                //on supprime le lien entre des heros liée a cette serie et ce comics
                foreach( $heros as $h){
                    $h2c=HeroToComics::where(["idHeros"=>$h->id,"idComics"=>$_POST["idComics"]]);
                    $h2c->delete();
                }
            }
        }
    }

    /*
     * cherche un comics selon une chaine
     * @param char(chaine de caractère recherché)
     */
    function findComics($char){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                //on cherche les comics correspondent
                $comics=Livre::where("titre","like","%".$char."%")->get();
                $serie=new Serie();
                //puis on récupère les comics liéé a des serie
                $co=$serie->serieBooks();
                //puis one filtre pour n'avoir que des comics qui ne sont pas liée a des serie
                $comics=$comics->diff($co);
                //puis on renvoit au js
                echo json_encode($comics);
            }
        }
    }


    /*
     * cherche les heros d'un comics selon une chaine
     * @param char(chaine de caractère recherché)
     * @param isbn(code d'identification d'un livre)
     */
    function findHero($char,$isbn){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $heros=Heros::where("nom","like","%".$char."%")->get();
                $h=new Heros();
                $co=$h->ComicsToHero($isbn);
                $heros=$heros->diff($co);
                echo json_encode($heros);
            }
        }
    }

    /*
     * cherche un comics qui n'est pas lié a ce heros
     */
    function findComicsToHero($char,$id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $comics=Livre::where("titre","like","%".$char."%")->get();
                $h=new Heros();
                $hco=$h->herosToBooks($id);
                $comics=$comics->diff($hco);
                echo json_encode($comics);
            }
        }
    }

    /*
     * cherche une serie qui n'est pas lié au heros
     * @param $char chaine transmise
     *        $id id du hero
     */
    function findSeriesToHero($char,$id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $serie=Serie::where("nom","like","%".$char."%")->get();
                $h=new Heros();
                $hse=$h->herosToSerie($id);
                $serie=$serie->diff($hse);
                echo json_encode($serie);
            }
        }
    }

    /*
     * ajoute un comics au hero
     */
    function addComics2hero(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $hero2Comics=new HeroToComics();
                $hero2Comics->idHeros= $_POST["idHeros"];
                $hero2Comics->idComics=$_POST["idComics"];
                $hero2Comics->save();
            }
        }
    }

    /*
     * ajoute une serie au hero
     */
    function addSerie2hero(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $serie2Comics=new HeroToSerie();
                $serie2Comics->idHeros= $_POST["idHeros"];
                $serie2Comics->idSerie=$_POST["idSerie"];
                $serie2Comics->save();
                $serie=new Serie();
                $serie=$serie->serieToBooks($_POST["idSerie"]);
                $heroModel=new Heros();
                $heroModel=$heroModel->herosToBooks($_POST["idHeros"]);
                $co=$serie->diff($heroModel);
                foreach ($co as $c){
                    $hero2Comics=new HeroToComics();
                    $hero2Comics->idHeros= $_POST["idHeros"];
                    $hero2Comics->idComics=$c->ISBN;
                    $hero2Comics->save();
                }
            }
        }
    }

    /*
     * supprime une série au heros
     */
    function suppSerie2Hero(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $h2c=HeroToSerie::where(["idSerie"=>$_POST["idSerie"],"idHeros"=>$_POST["idHeros"]]);
                $h2c->delete();
                $serie=new Serie();
                $serie=$serie->serieToBooks($_POST["idSerie"]);
                $heroModel=new Heros();
                $heroModel=$heroModel->herosToBooks($_POST["idHeros"]);
                $co=$serie->intersect($heroModel);
                foreach ($co as $c){
                    $c2h=HeroToComics::where(["idHeros"=> $_POST["idHeros"],"idComics"=>$c->ISBN]);
                    $c2h->delete();
                }
            }
        }
    }
    /*
     * supprime un comics a un hero
     */
    function suppComics2hero(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $res = false;
                $id = $_POST["idComics"];
                $idh = $_POST["idHeros"];
                //recherche si le comics est lié a une serie
                $serie = SerieToComics::where("idComics", "=", $id)->first();
                if ($serie != null) {
                    //si oui on regarde s'il le hero est liée a cette serie
                    $hs = HeroToSerie::where(["idHeros" => $idh, "idSerie" => $serie->idSerie])->first();
                    if ($hs == null) {
                        // si il n'est pas lié on supprime
                        $c2h = HeroToComics::where(["idHeros" => $idh, "idComics" => $id]);
                        $c2h->delete();
                        $res=true;
                    }
                    //sinon on ne fait rien
                } else {
                    // si il n'est pas lié on supprime
                    $c2h = HeroToComics::where(["idHeros" => $idh, "idComics" => $id]);
                    $c2h->delete();
                    $res=true;
                }
                echo json_encode( $res);
            }
        }
    }

    /*
     * supprime rapidement un comics
     */
    function suppComics(){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $isbn=$_POST["ISBN"];
                $comics=Livre::where("ISBN","=",$isbn);
                //supp envie
                $envie=Envie::where("ISBN","=",$isbn);
                $envie->delete();
                //sup la liason entre les heros et le comics
                $hc=HeroToComics::where("idComics","=",$isbn);
                $hc->delete();
                //supp la liason entre le user est le comics
                $pos=Possede::where("ISBN","=",$isbn);
                $pos->delete();
                //supp la liason entre la serie et le comics
                $sc=SerieToComics::where("idComics","=",$isbn);
                $sc->delete();
                //supp le comics
                $comics->delete();
            }
        }
    }

    /*
     * supprime un comics
     * genre dans un liste de co
     */
    function suppComicsget($isbn){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $comics=Livre::where("ISBN","=",$isbn);
                //supp envie
                $envie=Envie::where("ISBN","=",$isbn);
                $envie->delete();
                //sup la liason entre les heros et le comics
                $hc=HeroToComics::where("idComics","=",$isbn);
                $hc->delete();
                //supp la liason entre le user est le comics
                $pos=Possede::where("ISBN","=",$isbn);
                $pos->delete();
                //supp la liason entre la serie et le comics
                $sc=SerieToComics::where("idComics","=",$isbn);
                $sc->delete();
                //supp le comics
                $comics->delete();
                $app->redirect($app->urlFor('listComics'));
            }
        }
    }

    /*
     * supprime une serie rapidement
     * genre dans une liste de serie
     */
    function suppSerie(){

    }

    /*
     * supprime une serie
     */
    function suppSerieget($id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $s=Serie::where("id","=",$id)->first();
                $hs=$s->Heros()->get();
                $cs=$s->comics()->get();
                foreach($hs as $h){
                    foreach($cs as $c){
                        HeroToComics::where(["idComics"=>$c->ISBN,"idHeros"=>$h->id])->delete();
                    }
                }
                //supp envie
                HeroToSerie::where("idSerie","=",$id)->delete();
                SerieToComics::where("idSerie","=",$id)->delete();
                //supp le comics
                $s->delete();
                $app->redirect($app->urlFor('listSeries'));
            }
        }
    }

    /*
     * supprime un heros rapidement
     */
    function suppHero(){

    }

    /*
     * supprime un heros
     */
    function suppHeroget($id){
        $app = \Slim\Slim::getInstance();
        //on test si l'utilisateur est co
        if(isset($_SESSION["profile"])) {
            //on test s'il a les bons droit
            if ($_SESSION["profile"]["role_id"] == 2) {
                $h=Heros::where("id","=",$id);
                Enemi::where("heros","=",$id)->delete();
                Enemi::where("enemi","=",$id)->delete();

                Allie::where("heros","=",$id)->delete();
                Allie::where("allie","=",$id)->delete();

                HeroToComics::where("idHeros","=",$id)->delete();
                HeroToSerie::where("idHeros","=",$id)->delete();
                //supp le comics
                $h->delete();
                $app->redirect($app->urlFor('listHeros'));
            }
        }
    }
































    function downloadImG($chemin,$img,$nom){

        $res=false;
        if ($img["name"] != "" && $chemin!="") {
            //$target_file = $target_dir . basename($_FILES["img"]["name"]);
            //$uploadOk = 1;
            //$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $target_dir = $chemin;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo(basename($img["name"]), PATHINFO_EXTENSION));
            $target_file = $target_dir .$nom. "." . $imageFileType;

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($img["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                $check = move_uploaded_file($img["tmp_name"], $target_file);
                if ($check) {
                    echo "The file " . basename($img["name"]) . " has been uploaded.";
                    $res=true;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        return $res;
    }

    function downloadModImG($chemin,$img,$nom){

        $res=false;
        if ($img["name"] != "" && $chemin!="") {
            $target_dir = "$chemin";
            $uploadOk = 1;
            //$target_file = $target_dir . basename($_FILES["img"]["name"]);
            //$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $imageFileType = strtolower(pathinfo(basename($img["name"]), PATHINFO_EXTENSION));
            $target_file = $target_dir . $nom . "." . $imageFileType;

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($img["name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            // Mis en commentaire puisqu'un fichier du meme nom est sense deja exister
            /* if (file_exists($target_file)) {
                 echo "Sorry, file already exists.";
                 $uploadOk = 0;
             }*/

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($img["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["img"]["name"]) . " has been uploaded.";
                    $res = true;

                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        return $res;
    }

}