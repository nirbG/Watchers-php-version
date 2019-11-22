<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03/09/2018
 * Time: 19:42
 */

namespace watchers\controllers;


use watchers\models\Allie;
use watchers\models\Commentaire;
use watchers\models\Enemi;
use watchers\models\Envie;
use watchers\models\Heros;
use watchers\models\Livre;
use watchers\models\Note;
use watchers\models\Possede;
use watchers\models\Serie;
use watchers\models\User;
use watchers\vues\VueBd;

class ControllerBD
{
    /*
     * affiche la liste des heros par page de 30
     *
     * @param $numeroPage le numero de la page
     */
    function listH($numeroPage){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on test si l'utilisateur a modifier l'url pour avoir une page negative
            if($numeroPage<1){
                $numeroPage=1;
            }
            //on lance demande les 30 heros de cette page
            $h=Heros::orderBy('nom')->skip(($numeroPage-1)*30)->take(30)->get();
            //on calcul le nombre de page
            $page=Heros::all()->count()/30;
            //on test si la division n'a pas de reste
            if(Heros::all()->count()%30!=0){
                //s'il en reste on rajoute une page
                $page++;
            }
            //on initialise les donnée a envoyé a la vue
            $tuples=array("listHeros"=>$h,"page"=>$page,"current"=>$numeroPage);
            //on créer la vue
            $vue = new VueBd($tuples);
            $html = $vue->render(1);
            //on l'affiche
            echo $html;

        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     * affiche le detail d'un hero
     *
     * @param $id l'id du hero
     */
    function HeroDetail($id){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande les info du hero
            $h=Heros::where('id','=',$id)->first();
            //on demande les serie liée au hero
            $serie=$h->series()->get();
            //on demande les derniers comics sortie sur lui
            $books=$h->comics()->orderBy("date","desc")->get();
            $heros=new Heros();
            //on deamnde ses enemi
            $enemi=$heros->myEnemi($id);
            //on demande ses allie
            $allie=$heros->myAllie($id);
            //on demande ses team
            $team=$heros->myTeam($id);
            //on initialise les donnée a envoyé a la vue
            $tuples=array("heros"=>$h,"books"=>$books->take(6),"serie"=>$serie,"equipe"=>$team,"enemi"=>$enemi->take(4),"allie"=>$allie->take(4));
            //on créer la vue
            $vue = new VueBd($tuples);
            $html=$vue->render(2);
            //on affiche la page
            echo $html;
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     * affiche le detail d'une serie
     *
     * @param $id l'id de la serie
     */
    function SerieDetail($id){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande les info sur la serie choisis
            $s=Serie::where('id','=',$id)->first();
            //on demande les comics de la serie trié pas date
            $lc=$s->comics()->orderBy("date")->get();
            $depense=0;
            $manquant=0;
            $prixParDefaut=0;
            foreach ($lc as $c){
                $prix=$c->isPrixAchat();
                if($prix!=null){
                    $depense+=$prix;
                    $prixParDefaut+=$c->prix;
                }else{
                    $manquant+=$c->prix;
                }
            }
            $firs=$s->comics()->orderBy("date")->first();
            $y=date('Y',strtotime($firs->date));
            $m=date('m',strtotime($firs->date));
            $i=0;
            $nbSortie=0;
            $prixParAns=0;
            while($i<12){
                $sortieCeMois=Livre::where("serie","=",$id)->whereMonth('date','=', $m)->whereYear('date', '=', $y)->get();
                $prixParAns+=$sortieCeMois->sum("prix");
                $nbSortie+=$sortieCeMois->count();
                if($m==12){
                    $m=1;
                    $y++;
                }else{
                    $m++;
                }
                $i++;
            }
            //on demande le heros lier a cette série
            $h=$s->heros()->first();
            //on initialise les donnée a envoyé a la vue
            $tuples=array("serie"=>$s,           "listeComics"=>$lc,
                          "heros"=>$h,           "depense"=>$depense,
                          "manquant"=>$manquant, "prixParDefaut"=>$depense-$prixParDefaut,
                          "nbSortie"=>$nbSortie, "prixParAns"=>$prixParAns);
            //on créer la vue
            $vue=new VueBd($tuples);
            $html=$vue->render(3);
            //on afficge la page
            echo $html;
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     * affiche le detail d'un un livre
     *
     * @param $id l'id du livre
     */
    function livreDetail($isbn){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande les info sur le livre
            $b=Livre::where('ISBN','=',$isbn)->first();
            //on demande les info sur le heros
            $h=$b->heros()->get();
            //on demande les info sur la serie
            $s=$b->serie()->first();
            $prix="";
            if($b->isPossede()){
                $prix=$b->isPrixAchat();
            }
            $com=$b->commentaire();
            //on initialise les donnée a envoyé a la vue
            $tuples=array("livre"=>$b,"serie"=>$s,"heros"=>$h,"prix"=>$prix,"commentaire"=>$com);
            //on créer la vue
            $vue=new VueBd($tuples);
            $html=$vue->render(4);
            //on affiche la page
            echo $html;
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     * on affiche les livre qu'on posséde
     */
    function Collection(){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])) {
            //on demande les livre qu'on posséde
            $livre=new Livre();
            $livre =$livre->myBooks()->reverse();
            //on créer la vue
            $vue = new VueBd($livre);
            //on affiche la page
            echo $vue->render(5);
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }

    }
    /*
     * on affiche les heros des livre qu'on posséde
     */
    function CollectionHeros(){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])) {
            //on demande les id des heros des livre qu'on posséde
            $Heros=new Heros();
            $heros =$Heros->myHeros();

            $vue=new VueBd($heros);
            //on affiche la vue
            echo $vue->render(6);
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     * on affiche le detail d'un heros de nos livre
     * @param id l'id du heros
     */
    function CollectionHeroD($id){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])){
            //on demande le heros selon son id
            $heros=Heros::where('id','=',$id)->first();
            //on deamnde ses enemi
            $enemi=$heros->myEnemi($id);
            //on demande ses allie
            $allie=$heros->myAllie($id);
            //on demande ses team
            $team=$heros->myTeam($id);
            $livre=new Livre();
            $books=$livre->myBooks();//->orderBy("dateAjout","desc")->get();
            $tupleSerie= Array();
            $tupleBook= Array();
            $i=0;
            $tuple=null;
            foreach ($books as $l){
                $b=Livre::where("ISBN","=",$l->ISBN)->first();
                $bookHeros=$b->heros()->get();
                foreach ($bookHeros as $h){
                    if($h->id==$id) {
                        $tupleBook[$i] = $b;
                        $i++;
                        $s=$b->serie()->first();
                        if($s!=null){
                            $tuple[$s->id] = $s;

                        }
                    }
                }
            }
            $tuples=array("heros"=>$heros,"books"=>$tupleBook,"enemi"=>$enemi->take(4),"allie"=>$allie->take(4),"equipe"=>$team,"serie"=>$tuple);
            $vue = new VueBd($tuples);
            $html=$vue->render(7);
            echo $html;
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * affiche les serie liée au comics que le client posède
     */
    function CollectionSerie(){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])) {
            $livre = new Livre();
            // on recupère l'id des series du user et le nombre de livre qu'il a dans chaque serie
            $myS = $livre->mySeries();
            //on créer la vue
            $vue = new VueBd($myS);
            $html = $vue->render(8);
            //on affiche la page
            echo $html;
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     * on affiche la liste d'envie de l'utilisateur
     */
    function Envie(){
        //on test si le user est connecter
        if(isset($_SESSION["profile"])) {
            $livre = new Livre();
            // on recupère les livres dans la liste d'envie
            $myS = $livre->myEnvie();
            //on créer la vue
            $vue = new VueBd($myS);
            $html = $vue->render(9);
            //on affiche la page
            echo $html;
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app=\Slim\Slim::getInstance();
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     *  ajout d'un comics a la collection
     */
    function addComics2Col(){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
            $ISBN=$_POST["isbn"];
            $prix=$_POST["prix"];
            $pos=Possede::where(["ISBN"=>$ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->first();
            if($pos==null){
                $l=Livre::where("ISBN","=",$ISBN)->first();
                Envie::where(["ISBN"=>$ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->delete();
                $p=new Possede();
                $p->idUser=$_SESSION["profile"]["userid"];
                $p->ISBN=$ISBN;
                if($prix<0.1){
                    $p->prix=$l->prix;
                }else {
                    $p->prix=$prix;
                }
                $p->save();
                $app->redirect($app->urlFor('livreDetail', ["ISBN" => $p->ISBN]));
            }
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
    *  ajout d'un comics a la collection
    */
    function addFastCollection(){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
            $ISBN=$_POST["isbn"];
            $pos=Possede::where(["ISBN"=>$ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->first();
            if($pos==null) {
                Envie::where(["ISBN" => $ISBN, "idUser" => $_SESSION["profile"]["userid"]])->delete();
                $p = new Possede();
                $p->idUser = $_SESSION["profile"]["userid"];
                $p->ISBN = $ISBN;
                $p->save();
                echo("add");
            }else {
                echo "possede deja";
            }
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            echo("pas de compte");
        }
    }


    /*
     *  supp d'un comics a la collection
     */
    function suppComics2Col(){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
            $ISBN=$_POST["isbn"];
            Possede::where(["ISBN"=>$ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->delete();
            $app->redirect($app->urlFor('livreDetail', ["ISBN" => $ISBN]));
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
 *  ajout d'un comics a la liste d'envie
 */
    function addComics2Env(){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
            $ISBN=$_POST["isbn"];
            $pos=Envie::where(["ISBN"=>$ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->first();
            if($pos==null){
                $e=new Envie();
                $e->idUser=$_SESSION["profile"]["userid"];
                $e->ISBN=$ISBN;
                $e->save();
                $app->redirect($app->urlFor('livreDetail', ["ISBN" => $e->ISBN]));
            }
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     *  supp d'un comics a la liste d'envie
     */
    function suppComics2Env(){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
            $ISBN=$_POST["isbn"];
            Envie::where(["ISBN"=>$ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->delete();
            $app->redirect($app->urlFor('livreDetail', ["ISBN" => $ISBN]));
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * ajout d'un comics par sont ISBN ou EAN
     */
    function addFastById(){
        $id=$_POST["ISBNEAN"];
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
           $comics=Livre::where('ISBN', '=', $id)
                ->orWhere('EAN','=',$id)
                ->first();
           if($comics!=null){
               $pos=Possede::where(["ISBN"=>$comics->ISBN,"idUser"=>$_SESSION["profile"]["userid"]])->first();
               if($pos==null) {
                   Envie::where(["ISBN" => $comics->ISBN, "idUser" => $_SESSION["profile"]["userid"]])->delete();
                   $p = new Possede();
                   $p->idUser = $_SESSION["profile"]["userid"];
                   $p->ISBN = $comics->ISBN;
                   $p->save();
                   $app->redirect($app->urlFor('livreDetail', ["ISBN" => $p->ISBN]));
               }else {
                    $app->redirect($app->urlFor('AddByIdInfo',["type"=>"possedeDeja","id" => $comics->ISBN]));
               }
           }else{
               //A faire V2
               $app->redirect($app->urlFor('AddByIdInfo',["type"=>"notfound","id" =>$id]));
           }
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }
    /*
     *
     */
    function AddByIdInfo($type,$id){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
            $html="";
            switch ($type){
                case "possedeDeja":
                    $cont=Livre::where("ISBN","=",$id)->first();
                    $vue=new VueBd($cont);
                    $html=$vue->render(10);
                    break;
                case "notfound":
                    $vue=new VueBd($id);
                    $html=$vue->render(11);
                    break;
            }
            echo $html;
        }else{
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * modifie les information de l'utilisateur
     *
     */
    function updateInfo(){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])) {
            $pseudo=$_POST["pseudo"];
            $email=$_POST["email"];
            if(($pseudo!=null)&&($email!=null)){
                $user=User::where("id","=",$_SESSION["profile"]["userid"])->first();
                $user->mail=$email;
                $user->pseudo=$pseudo;
                $user->save();
            }
        }else {
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * modifie ou ajoute ta note
     */
    function note($isbn){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])){
            $note=$_POST["note"];
            $mynote=Note::where(["idUser"=>$_SESSION["profile"]["userid"],"ISBN"=>$isbn])->first();
            if($mynote==null) {
                $newNote = new Note();
                $newNote->idUser = $_SESSION["profile"]["userid"];
                $newNote->ISBN = $isbn;
                $newNote->note = $note;
                $newNote->save();
            }else{
                Note::where('idUser', '=', $_SESSION["profile"]["userid"])->where('ISBN', '=', $isbn)->update(['note' => $note]);
            }
            $n=new Note();
            $cnt=$n->countNote($isbn);
            if($cnt<2){
                echo "$note/5 sur 1 vote";
            }else{
                $avg=$n->moy($isbn);
                echo "$avg/5 sur $cnt votes";
            }
        }else {
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }

    /*
     * ajoute un commentaire
     */
    function addCom($isbn){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])){

            $next_com_id = Commentaire::max('id') + 1;
            $com=new Commentaire();
            $com->isbn=$isbn;
            $com->user=$_SESSION["profile"]["userid"];
            $com->commentaire=$_POST["commentaire"];
            $com->save();
            echo json_encode(["date"=> date("Y-m-d H:i:s"),"id"=>$next_com_id]);
        }else {
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }

    }
    /*
     * affiche un commentaire
     */
    function afficheCom($isbn){
        $app=\Slim\Slim::getInstance();
        if(isset($_SESSION["profile"])){
            $id=$_POST["lastId"];
            $newC=Commentaire::where('id', '>', $id)->where('isbn','=',$isbn)->get();
            $cont="";
            $id=0;
            foreach ($newC as $c){
                $user=User::where("id","=",$c->user)->first();
                $id=$c->id;
                $cont.=<<<end
                    <div class=" col-9 talk-bubble tri-right border-bubble round btm-left-in" id="$c->id">
                        <div class="talktext">
                            <h4>$user->pseudo</h4>
                            <p>$c->commentaire</p>
                            <p style="text-align: right;margin-bottom: 0%;">$c->date</p>
                        </div>
                    </div>
end;
            }
            echo json_encode(["message"=> $cont,"id"=>$id]);
        }else {
            //si le user n'est pas co alors on le redirige a la page d'acceuil
            $app->redirect($app->urlFor('accueil'));
        }
    }
}
