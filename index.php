<?php

require 'vendor/autoload.php';

use watchers\controllers\ControllerAccueil;
use watchers\controllers\ControllerConnexion;
use watchers\controllers\ControllerBD;
use watchers\controllers\ControllerSearch;
use watchers\controllers\ControllerAdmin;

\configuration\Eloquent::init('src/configuration/config.ini');


$app = new \Slim\Slim;

/* Démarrage de la session pour éviter de le faire à chaque fois */
session_start();

// Route Accueil


$app->get('/', function() {
    $accueil = new ControllerAccueil();
    if (isset($_SESSION['profile'])) {
        $accueil->afficherAccueilConnecte();
    } else {
        $accueil->afficherAccueil();
    }
})->name('accueil');

/* Connexion d'un utilisateur */
$app->get('/connexion:erreur', function($erreur) {
    $connexion = new ControllerConnexion();
    $connexion->afficherConnexionFormulaire($erreur);
})->name("formCo");

/* Verification des données de l'utilisateur */
$app->post('/connect', function () {
    $connexion = new ControllerConnexion();
    $connexion->seConnecter();
})->name("connexion");

/* Deconnexion d'un utilisateur */
$app->get('/deconnexion', function () {
    unset($_SESSION["profile"]);
    $app = \Slim\Slim::getInstance();
    $app->response()->redirect($app->urlFor('accueil'));
})->name("deconnexion");

/* Affichage page d'inscription */
$app->get('/inscription:erreur', function($erreur) {
    $inscription = new ControllerConnexion();
    $inscription->afficherInscriptionFormulaire($erreur);
})->name("formInsc");

/* Verification Inscription */
$app->post('/inscription/validation', function () {
    $inscription = new ControllerConnexion();
    $inscription->sinscrire();
})->name('sinscrire');

/* Mot de passe oublié */
$app->get('/forgotpasswd', function() {
    $controller = new ControllerConnexion();
    $controller->affichageMdpOublie();
})->name("passwForgot");

/* Envoyer mail suite au mot de passe oublié */
$app->post('/forgotpasswd/mail', function () {
    $controller = new ControllerConnexion();
    $controller->envoyerMail();
    $app = \Slim\Slim::getInstance();
    $app->response()->redirect($app->urlFor('accueil'));
})->name("envoyerMail");

$app->get('/forgotpasswd/:hash', function ($hash) {
    $controller = new ControllerConnexion();
    $_SESSION['hash'] = $hash;
    $controller->affichageMdpModif();
})->name("reinitPasswd");

$app->post('/forgotpasswd/submit', function () {
    $controller = new ControllerConnexion();
    $verif = $controller->modifierMdp($_SESSION['hash']);
    unset($_SESSION['hash']);
    $app = \Slim\Slim::getInstance();
    if ($verif == true)
        $app->response()->redirect($app->urlFor('accueil'));
})->name("reinitPasswdOK");

$app->post('/updateInfo', function () {
    $controller = new ControllerBD();
    $controller->updateInfo();
})->name("updateInfo");

/* afficher la liste des heros de la page nbP */
$app->get('/heros:nbP',function($nbP){
    if (isset($_SESSION['profile'])) {
        $heros = new ControllerBD();
        $heros->listH($nbP);
    } else {
        $app = \Slim\Slim::getInstance();
        $app->response()->redirect($app->urlFor('accueil'));
    }
})->name('Heros');

/* afficher le detail d'un heros */
$app->get('/HeroDetail/:id',function($id){
    (new ControllerBD())->HeroDetail($id);
})->name('HeroDetail');

/* afficher une serie */
$app->get('/Serie/:id',function($id){
    (new ControllerBD())->SerieDetail($id);
})->name('SerieDetail');

/* afficher le detail d'un livre */
$app->get('/livreDetail/:ISBN',function($ISBN){(
    new ControllerBD())->livreDetail($ISBN);
})->name('livreDetail');

/*note*/
$app->post('/livreDetail/:ISBN/note',function($ISBN){(
    new ControllerBD())->Note($ISBN);
})->name('note');

/* afficher sa collection */
$app->get('/Collection',function(){(
    new ControllerBD())->Collection();
})->name('Collection');

/* afficher les heros de sa collection */
$app->get('/CollectionHeros',function(){
    (new ControllerBD())->CollectionHeros();
})->name('CollectionHeros');

/* afficher ses comics selon un heros */
$app->get('/CollectionHeroD/:id',function($id){
    (new ControllerBD())->CollectionHeroD($id);
})->name('CollectionHeroD');

/* afficher ses serie */
$app->get('/CollectionSerie',function(){
    (new ControllerBD())->CollectionSerie();
})->name('CollectionSerie');


/* afficher ses envie */
$app->get('/Envie',function(){
    (new ControllerBD())->Envie();
})->name('Envie');


/* add ses envie */
$app->post('/addComics2Env',function(){
    (new ControllerBD())->addComics2Env();
})->name('addComics2Env');

/* supp ses envie */
$app->post('/suppComics2Env',function(){
    (new ControllerBD())->suppComics2Env();
})->name('suppComics2Env');

/* add ses coll */
$app->post('/addComics2Col',function(){
    (new ControllerBD())->addComics2Col();
})->name('addComics2Col');

/* supp ses coll */
$app->post('/suppComics2Col',function(){
    (new ControllerBD())->suppComics2Col();
})->name('suppComics2Col');

/******ADDFAST******ADDFAST******ADDFAST******ADDFAST******ADDFAST******ADDFAST******ADDFAST******ADDFAST******ADDFAST******ADDFAST******/

/* add ses envie */
$app->post('/addFastEnvie',function(){
    (new ControllerBD())->addFastEnvie();
})->name('addFastEnvie');

/* supp ses envie */
$app->post('/suppFastEnvie',function(){
    (new ControllerBD())->suppFastEnvie();
})->name('suppFastEnvie');

/* add ses coll */
$app->post('/addFastCollection',function(){
    (new ControllerBD())->addFastCollection();
})->name('addFastCollection');

/* supp ses coll */
$app->post('/suppFastCollection',function(){
    (new ControllerBD())->suppFastCollection();
})->name('suppFastCollection');

/* ajout by Isbn ou EAN */
$app->post('/addFastById',function(){
    (new ControllerBD())->addFastById();
})->name('addFastById');

/* page info add by ISBN ou EAN */
$app->get('/AddByIdInfo/:type/:id',function($type,$id){
    (new ControllerBD())->AddByIdInfo($type,$id);
})->name('AddByIdInfo');

/******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******/
/* ajouter un commmentaire sur un livre */
$app->post('/livreDetail/:ISBN/addCom',function($ISBN){(
new ControllerBD())->addCom($ISBN);
})->name('addCom');

/* afficher un commmentaire sur un livre */
$app->post('/livreDetail/:ISBN/afficheCom',function($ISBN){(
new ControllerBD())->afficheCom($ISBN);
})->name('affichCom');

/******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******SEARCH******/

$app->post('/SearchBack/',function(){
    (new ControllerSearch())->rechercher();
})->name('SearchBack');

$app->get('/Search/:content',function($content){
    (new ControllerSearch())->rechercherVue($content);
})->name('Search');

//seachDetailHeros
$app->get('/seachDetailHeros/:content',function($content){
    (new ControllerSearch())->rechercherHeros($content);
})->name('seachDetailHeros');

//seachDetailSerie
$app->get('/seachDetailSerie/:content',function($content){
    (new ControllerSearch())->rechercherSeries($content);
})->name('seachDetailSerie');

//seachDetailComics
$app->get('/seachDetailComics/:content',function($content){
    (new ControllerSearch())->rechercherComics($content);
})->name('seachDetailComics');

/******ADMIN******ADMIN******ADMIN******ADMIN******ADMIN******ADMIN******ADMIN******ADMIN******ADMIN******ADMIN******ADMIN******/

$app->get('/admin/',function(){
    (new ControllerAdmin())->adminHome();
})->name('adminHome');
//list H & S & C
$app->get('/admin/listHeros',function(){
    (new ControllerAdmin())->listHeros();
})->name('listHeros');
$app->get('/admin/listSerie',function(){
    (new ControllerAdmin())->listSerie();
})->name('listSeries');
$app->get('/admin/listComics',function(){
    (new ControllerAdmin())->listComics();
})->name('listComics');

//LIVRE
$app->get('/admin/livreMOD/:ISBN',function($ISBN){(
    new ControllerAdmin())->livreMOD($ISBN);
})->name('livreMOD');
$app->post('/admin/updatelivre/:ISBN',function($ISBN){
    (new ControllerAdmin())->updatelivre($ISBN);
})->name('updatelivre');

//SERIE
$app->get('/admin/serieMOD/:id',function($id){
    (new ControllerAdmin())->serieMOD($id);
})->name('serieMOD');
$app->post('/admin/updateSerie/:id',function($id){
    (new ControllerAdmin())->updateSerie($id);
})->name('updateSerie');

//heroMOD
$app->get('/admin/heroMOD/:id',function($id){
    (new ControllerAdmin())->heroMOD($id);
})->name('heroMOD');
$app->post('/admin/updateHero/:id',function($id){
    (new ControllerAdmin())->updateHero($id);
})->name('updateHero');

//création hero
$app->get('/admin/newHero',function (){(new ControllerAdmin())->newHero();})->name("newHero");
$app->post('/admin/addHero',function (){(new ControllerAdmin())->addHero();})->name("addHero");

//création serie
$app->get('/admin/newSerie',function (){
    (new ControllerAdmin())->newSerie();
})->name("newSerie");
$app->post('/admin/addSerie',function (){
    (new ControllerAdmin())->addSerie();
})->name("addSerie");

//création Comics
$app->get('/admin/newComics',function (){
    (new ControllerAdmin())->newComics();
})->name("newComics");
$app->post('/admin/addComics',function (){
    (new ControllerAdmin())->addComics();
})->name("addComics");

//ajout et suppression de co a des series
$app->post('/admin/addComics2Serie',function (){
    (new ControllerAdmin())->addComics2Serie();
})->name("addComics2Serie");
$app->post('/admin/suppComics2Serie',function (){
    (new ControllerAdmin())->suppComics2Serie();
})->name("suppComics2Serie");

//find something
$app->get('/findComics/:char',function ($char){
    (new ControllerAdmin())->findComics($char);
})->name("FindComics");
$app->get('/findHero/:char/:isbn',function ($char,$isbn){
    (new ControllerAdmin())->findHero($char,$isbn);
})->name("FindHero");
$app->get('/findComicsToHero/:char/:id',function ($char,$id){
    (new ControllerAdmin())->findComicsToHero($char,$id);
})->name("FindComicsToHero");
$app->get('/findSeriesToHero/:char/:idh',function ($char,$idh){
    (new ControllerAdmin())->findSeriesToHero($char,$idh);
})->name("findSeriesToHero");

//ajout et suppression de co a des heros
$app->post('/admin/addComics2hero',function (){
    (new ControllerAdmin())->addComics2hero();
})->name("addComics2hero");
$app->post('/admin/suppComics2hero',function (){
    (new ControllerAdmin())->suppComics2hero();
})->name("suppComics2hero");

//ajout et suppression de serie a des series
$app->post('/admin/addSerie2hero',function (){
    (new ControllerAdmin())->addSerie2hero();
})->name("addSerie2hero");
$app->post('/admin/suppSerie2Hero',function (){
    (new ControllerAdmin())->suppSerie2Hero();
})->name("suppSerie2Hero");


//supp element
$app->post('/admin/suppComics',function (){
    (new ControllerAdmin())->suppComics();
})->name("suppComics");
$app->get('/admin/suppComicsget/:ISBN',function ($ISBN){
    (new ControllerAdmin())->suppComicsget($ISBN);
})->name("suppComicsget");
$app->post('/admin/suppHero',function (){
    (new ControllerAdmin())->suppHero();
})->name("suppHero");
$app->get('/admin/suppHeroget/:id',function ($id){
    (new ControllerAdmin())->suppHeroget($id);
})->name("suppHeroget");
$app->post('/admin/suppSerie',function (){
    (new ControllerAdmin())->suppSerie();
})->name("suppSerie");
$app->get('/admin/suppSerieget/:id',function ($id){
    (new ControllerAdmin())->suppSerieget($id);
})->name("suppSerieget");


$app->run();

