<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25/09/2018
 * Time: 16:57
 */

namespace watchers\vues;


use watchers\models\Livre;
use watchers\models\Note;
use watchers\models\User;

class VueFactory
{

    /*
 * UTILS
 */


    STATIC function  listComics($liste,$chemin,$app) {
        $comicsConts="";
        foreach ($liste as $c){
            $env = "";
            if (!$c->isEnvie()) {
                $env .= "<button class='btn btnEnvie col-12'><i class='fas fa-heart'></i></button>";
            }else{
                $env .= "<button class='btn btnBanEnvie col-12'><i class='fas fa-ban'></i></button>";
            }
            if (!$c->isPossede()) {
                $env .= "<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>";
            }else{
                $env="<button class='btn btnSupp col-12'><i class='fas fa-minus'></i></button>";
            }
            $url=$app->urlFor('livreDetail', ["ISBN" => $c->ISBN]);
            $img=$chemin."theme/ressources/livre/$c->img";
            $rating=VueFactory::rating($c->ISBN);
            $comicsConts.=<<<END
            <div class="col-2 comics card-catalogue" isbn="$c->ISBN">
                <div class="col-lg-1 checkbox" style="text-align: center;padding-top: 40px"><input type="checkbox" id="scales" ></div>
                <div class="col-lg-12 card-containerSearch" style="background: url($img) center no-repeat;background-size: 100% 100%;" >
                    <div class="card-body" style="text-align: center;padding: 50px 0px;">
                    $rating
                        <div class="listBtn">
                            <a href="$url"><button class="btn btnInfo col-12 "><i class="fas fa-info"></i></i></button></a>
                            $env
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <div class=" col-10 row listInfo">
                    <div class="col-10">
                        <h3><a href="$url">titre :$c->titre</a></h3>
                        <h5>4/5 sur 10 votes</h5>
                    </div>
                    <div class="col-2 row listInfoBtn">
                        $env
                    </div>
                </div>
            </div>
END;
        }
        return $comicsConts;
    }

    STATIC function  listComicsSerie($liste,$chemin,$app) {
        $comicsConts="";
        foreach ($liste as $c){
            $pos="";
            $env = "";
            if (!$c->isEnvie()) {
                $env .= "<button class='btn btnEnvie col-12'><i class='fas fa-heart'></i></button>";
            }else{
                $env .= "<button class='btn btnBanEnvie col-12'><i class='fas fa-ban'></i></button>";
            }
            if (!$c->isPossede()) {
                $env .= "<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>";
            }else{
                $pos="possede";
                $env="<button class='btn btnSupp col-12'><i class='fas fa-minus'></i></button>";
            }
            $url=$app->urlFor('livreDetail', ["ISBN" => $c->ISBN]);
            $img=$chemin."theme/ressources/livre/$c->img";
            $rating=VueFactory::rating($c->ISBN);
            $comicsConts.=<<<END
            <div class="col-lg-2 comics $pos card-catalogue" isbn="$c->ISBN" style="display: none">
                <div class="col-lg-1 checkbox" style="text-align: center;padding-top: 40px"><input type="checkbox" id="scales" ></div>
                <div class="col-lg-12 card-containerSearch" style="background: url($img) center no-repeat;background-size: 100% 100%;" >
                    <div class="card-body" style="text-align: center;padding: 50px 0px;">
                    $rating
                        <div class="listBtn">
                            <a href="$url"><button class="btn btnInfo col-12 "><i class="fas fa-info"></i></i></button></a>
                            $env
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <div class=" col-10 row listInfo">
                    <div class="col-10">
                        <h3><a href="$url">titre :$c->titre</a></h3>
                        <h5>4/5 sur 10 votes</h5>
                    </div>
                    <div class="col-2 row listInfoBtn">
                        $env
                    </div>
                </div>
            </div>
END;
        }
        return $comicsConts;
    }

    STATIC function  listEnv($liste,$chemin,$app) {
        $comicsConts="";
        foreach ($liste as $c){
            $env="";
            $env .= "<button class='btn btnBanEnvie col-12'><i class='fas fa-ban'></i></button>";
            $env .= "<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>";
            $url=$app->urlFor('livreDetail', ["ISBN" => $c->ISBN]);
            $img=$chemin."theme/ressources/livre/$c->img";
            $rating=VueFactory::rating($c);
            $comicsConts.=<<<END
            <div class="col-lg-2 comics card-catalogue" isbn="$c->ISBN">
                <div class="col-lg-1 checkbox" style="text-align: center;padding-top: 40px"><input type="checkbox" id="scales" ></div>
                <div class="col-lg-12 card-containerSearch" style="background: url($img) center no-repeat;background-size: 100% 100%;"  >
                    <div class="card-body" style="text-align: center;padding: 50px 0px;">
                    $rating
                        <div class="listBtn">
                            <a href="$url"><button class="btn btnInfo col-12 "><i class="fas fa-info"></i></i></button></a>
                            $env
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <div class=" col-10 row listInfo">
                    <div class="col-10">
                        <h3><a href="$url">titre :$c->titre</a></h3>
                        <h5>4/5 sur 10 votes</h5>
                    </div>
                    <div class="col-2 row listInfoBtn">
                        $env
                    </div>
                </div>
            </div>
END;
        }
        return $comicsConts;
    }




    STATIC function listeSerie($liste,$app) {
        $serieCont="";
        if($liste!=null) {
            $livre = new Livre();
            foreach ($liste as $s) {
                $url = $app->urlFor('SerieDetail', ["id" => $s->id]);
                $numberComics = $livre->mySeriesnumber($s->id);
                $complet = "serieNONComplete";
                if ($numberComics == $s->nblivre) {
                    $complet = "serieComplete";
                }
                $serieCont .= <<<END
            <div class=" serie card  col-lg-12" style="padding: 0">
                <a href="$url">
                <h5 class=" row col-12" style="margin: 1% 0%;color: black"><div class="overflow-ellipsis">$s->nom</div><strong class="$complet" style="width: 20%;text-align: right">$numberComics/$s->nblivre</strong></h5>
                </a>
            </div>
END;
            }

        }else{
            $serieCont="<div class='col-lg-12'  style='text-align: center'>
                <h5> aucune serie </h5>
                </div>";
        }
        return $serieCont;
    }

    STATIC function listeHeros($liste,$chemin,$redirige,$app){
        $herosCont="";
        foreach ($liste as $h) {
            $url = $app->urlFor($redirige, ["id" => $h->id]);
            $urlimg=$chemin."theme/ressources/heros/$h->img";
            $herosCont .= <<<END
<!-- Card -->
<div class="card-cascade heroCatalogue col" >
  <a href="$url" class="heroCatalogue" >
    <div class="hero">
    <!-- Card image -->
        <div class="view view-cascade gradient-card-header blue-gradient" style="padding: 0">
            <img class="col-lg-12 heroImg" src="$urlimg" >
        </div>
        <!-- Card content -->
        <div class="card-body card-body-cascade text-center">
        <!-- Text -->
        <div class="card-text">$h->nom</div>
            <hr class="shine heroShine " >
        </div>
    </div>
  </a>
</div>
END;
        }
        return $herosCont;
    }

    STATIC function footer($black,$chemin,$app){
        $footerClass="page-footer";
        $footerCopyright="footer-copyright";
        $shine="shine";
        $white="";
        if($black){
            $footerClass="page-footer-black";
            $footerCopyright="footer-copyright-black";
            $shine="shineDark";
            $white="style='color: white'";
        }
        $urlA = $app->urlFor("accueil");
        $urlDeco = $app->urlFor("deconnexion");

        return <<<END
     <footer class="$footerClass center-on-small-only " $white>
        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">
                <!--First column-->
                <div class=" row col-md-6">  
                    <h3 style="float: left" class="col-6 masthead-brand" id="Watcher"><a href="$urlA"><img style="float: left;padding-top: 0%" src="$chemin/ressources/logo.png" ></a></h3>
                    <div class="col-lg-6" style="text-align: left">Découvrez et partagez autour de votre passion pour les comics, enrichissez la base de données et gérez votre collection gratuitement avec la bliotheque des Watchers.</div>
                </div>
                <!--/.First column-->
                <!--Second column-->
                <div class="col-md-6">
                    <h5 class="title">Quelques liens utiles :</h5>
                    <ul>
                        <li><a href="$urlDeco">Déconnexion  </a></li>
                    </ul>
                </div>
                <!--/.Second column-->
            </div>
            <hr class="$shine Shine " >
        </div>
        <!--/.Footer Links-->
        <!--Copyright-->
        <div class="$footerCopyright">
        
            <div class="container-fluid">
                <strong>Projet perso </strong>
            </div>
        </div>
        <!--/.Copyright-->
     </footer>
END;

    }

    STATIC function  rating($isbn){
        $note=new Note();
        $rating=$note->moy($isbn);
        switch (round($rating)){
            case 0;
                return <<<END
                <div class="row"><i class="far fa-star "></i><i class="far fa-star "></i><i class="far fa-star "></i><i class="far fa-star "></i><i class="far fa-star "></i></div>
END;
            case 1;
                return <<<END
                <div class="row"><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
END;
            case 2;
                return <<<END
                <div class="row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
END;
            case 3;
                return <<<END
                <div class="row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
END;
            case 4;
                return <<<END
                <div class="row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
END;
            case 5;
                return <<<END
                <div class="row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
END;
        }

}
    STATIC function  ratingDetail($isbn){
        $note=new Note();
        $rating=round($note->moy($isbn));
        $numbervote=Note::where("ISBN","=",$isbn)->count();
        if($numbervote<2){
            $numbervote=$numbervote." vote" ;
        }else{
            $numbervote=$numbervote." votes" ;
        }
        return <<<end
            <section class='rating-widget'>
                  <div class='rating-stars text-right'>
                      <ul id='stars'>
                         <li class='star' title='Poor' data-value='1'>
                            <i class='fa fa-star fa-fw'></i>
                         </li>
                         <li class='star' title='Fair' data-value='2'>
                            <i class='fa fa-star fa-fw'></i>
                         </li>
                         <li class='star' title='Good' data-value='3'>
                            <i class='fa fa-star fa-fw'></i>
                         </li>
                         <li class='star' title='Excellent' data-value='4'>
                            <i class='fa fa-star fa-fw'></i>
                         </li>
                         <li class='star' title='WOW!!!' data-value='5'>
                            <i class='fa fa-star fa-fw'></i>
                         </li>
                      </ul>
                  </div>
                  <h5>$rating/5 sur $numbervote</h5>
            </section>
end;


    }
    STATIC function  commentaireDetail($commentaires){
        $cont="";
        $lastId=-1;
        foreach ($commentaires as $c){
            if($c->user==$_SESSION["profile"]["userid"]){
                $cont.=<<<you
                    <div class="offset-3 col-9 talk-bubble tri-right border-bubble round btm-right-in" id="$c->id">
                        <div class="talktext">
                            <h4>Vous</h4>
                            <p>$c->commentaire</p>
                            <p style="text-align: right;margin-bottom: 0%;">$c->date</p>
                        </div>
                    </div>
you;
            }else{
                $user=User::where("id","=",$c->user)->first();
                $cont.=<<<cont
                    <div class=" col-9 talk-bubble tri-right border-bubble round btm-left-in" id="$c->id">
                        <div class="talktext">
                            <h4>$user->pseudo</h4>
                            <p>$c->commentaire</p>
                            <p style="text-align: right;margin-bottom: 0%;">$c->date</p>
                        </div>
                    </div>
cont;
            }
            $lastId=$c->id;
        }
        return <<<end
                <div class="col-12 row commentaireDetail" style="height: 420px;margin-bottom:2%;overflow:  hidden visible;" lastid="$lastId">
                    $cont
                </div>
end;

    }
}