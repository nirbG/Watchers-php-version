<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/09/2018
 * Time: 19:34
 */

namespace watchers\vues;


use watchers\models\Livre;

class VueSearch
{

    private $content;

    function __construct($req = null) {
        $this->content = $req;
    }

    public function render($id)
    {
        $app = \Slim\Slim::getInstance();
        $js = "";
        $theme = "theme";
        $bootstrap = "bootstrap";
        $MDB = "MDB";
        $urlA = $app->urlFor("accueil");
        $urlH =$app->urlFor("Heros", ["nbP" => 1]);
        $urlAllC =$app->urlFor("Collection");
        $urlALLCH =$app->urlFor("CollectionHeros");
        $urlALLCS =$app->urlFor("CollectionSerie");
        $urlDeco = $app->urlFor("deconnexion");
        $urlEnv = $app->urlFor("Envie");
        $urlS = $app->urlFor("SearchBack");
        $bd = "";
        $h = "";
        $c = "";
        $a = "";
        //initialisation
        switch ($id) {

            case 0:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->Search($app);
                $js=<<<END
                <script type='text/javascript' src='../theme/js/add.js'></script>
END;
            break;
            case 1:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->rechercherHeros($app);
                $js=<<<END
END;
            break;
            case 2:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->rechercherSeries($app);
                $js=<<<END
END;
                break;
            case 3:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->rechercherComics($app);
                $js=<<<END
                <script type='text/javascript' src='../theme/js/add.js'></script>
END;
                break;
        }

        return <<<END
<!DOCTYPE html>
<html lang="fr" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="$theme/ressources/logoOnglet.png">

    <title>Your event </title>

    <!-- Bootstrap core CSS -->
    <link href=" $bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href=" $theme/css/fontawesome.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href=" $bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="bootstrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="$bootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="$theme/css/main.css" rel="stylesheet">
    <link href="$theme/css/all.css" rel="stylesheet">
    <link href="$MDB/css/style.css" rel="stylesheet">
    
  </head>
  <body >
     <nav class="navbar navbar-expand-lg navbar-Orange fixed-top bg-dark">
        <h3 style="float: left" class="col-4 masthead-brand" id="Watcher"><a href="$urlA"><img style="float: left;padding-top: 0%" src="$theme/ressources/logo.png" ></a></h3>
        <div class="row navbar-toggler" type="button">
            <div class="" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <button class=" button-toggle-navigation">
                    <span class=""></span>
                </button>
            </div>
        </div>
        <div class=" collapse navbar-collapse" id="navbarCollapse" style="margin-left: 2%">
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item $bd">
                    <a class="nav-link" href="$urlA">Ma bedetheque</a>
                </li>
                <li class="nav-item ">
                    <p class="nav-link" style="color: white;margin: 0;">|</p>
                </li>
                <li class="nav-item $h">
                    <a class="nav-link" href="$urlH">Héros</a>
                </li>
                <li class="nav-item ">
                    <p class="nav-link" style="color: white;margin: 0;">|</p>
                </li>
                <li class="nav-item $c dropdown">
                    <a class="nav-link dropdown-content" href="" style="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Ma collection</a>
                    <ul class="dropdown-menu multi-level" style="padding: 0 0;" role="menu" aria-labelledby="dropdownMenu">
                        <li class=""><a class="dropdown-item "  href="$urlAllC">tous mes comics</a></li>
                        <li class=""><a class="dropdown-item " href="$urlALLCH">trié par héros</a></li>
                        <li class=""><a class="dropdown-item " href="$urlALLCS">trié par série</a></li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <p class="nav-link" style="color: white;margin: 0;">|</p>
                </li>
                <li class="nav-item $a">
                    <a class="nav-link" href="$urlEnv">Ma liste d'envie</a>
                </li>
                <li class="nav-item">
                    <form class="nav-link form-inline mt-2 mt-md-0" style="margin: 0;padding: 0" onsubmit="return Form.module.search.start()"  action="$urlS" method="post">
                        <input id="search" class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                    </form>
                </li>
            </ul>
        </div>
     </nav>
     $cont    
     <!--Footer-->
     <footer class="page-footer center-on-small-only ">
        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">
                <!--First column-->
                <div class=" row col-md-6">  
                    <h3 style="float: left" class="col-6 masthead-brand" id="Watcher"><a href="$urlA"><img style="float: left;padding-top: 0%" src="$theme/ressources/logo.png" ></a></h3>
                    <div class="col-6" style="text-align: left">Découvrez et partagez autour de votre passion pour les comics, enrichissez la base de données et gérez votre collection gratuitement avec la bliotheque des Watchers.</div>
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
            <hr class="shine Shine " >
        </div>
        <!--/.Footer Links-->
        <!--Copyright-->
        <div class="footer-copyright">
        
            <div class="container-fluid">
                <strong>Projet perso </strong>
            </div>
        </div>
        <!--/.Copyright-->
     </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="$bootstrap/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--script src="bootstrap/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel=stylesheet href=https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css>
    <script src=https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js></script>
    <script src="$bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <script type='text/javascript' src='$theme/js/formsearch.js'></script>
    <script type='text/javascript' src='$theme/js/HideAndShowSection.js'></script>
         <script type='text/javascript' src='MDB/js/mdb.min.js'></script>
    $js
                <script>
                $('.button-toggle-navigation').on('click', function() {
                    $(this).toggleClass('isActive');
                });
            </script>
    
  </body>
</html>
END;

    }


    //case 0
    function Search($app){

        $chianeSearch=$this->content["chianeSearch"];

        //SERIES
        //*************************************************************************************************************
        $listeSerie=$this->content["listeSerie"];
        $seemore="";
        if(sizeof($listeSerie)>3){
            $listeSerie= $listeSerie->take(3);
            $url = $app->urlFor('seachDetailSerie', ["content" =>$chianeSearch ]);
            $seemore=<<<END
            <div class=" serie card  col-lg-12" style="padding: 0">
                <a href="$url">
                <h5 class="col-12" style="text-align:center;margin: 1% 0%;color: #740f00;">Voir plus</h5>
                </a>
            </div>

END;
        }
        //list des serie
        $serieCont=VueFactory::listeSerie($listeSerie,$app);

        $serieCont.=$seemore;

         //HEROS
        //*************************************************************************************************************
        $listeHeros=$this->content["listeHeros"];
        $seemore="";
        if(sizeof($listeHeros)>11){
            $listeHeros= $listeHeros->take(11);
            $url = $app->urlFor('seachDetailHeros', ["content" =>$chianeSearch ]);
            $seemore=<<<END
<!-- Card -->
<div class=" col-2 card-cascade heroCatalogue" >
  <a href="$url" class="heroCatalogue" >
    <div class="hero">
    <!-- Card image -->
        <div class="view view-cascade gradient-card-header blue-gradient" style="padding: 0">
               <img class="col-lg-12" src="../theme/ressources/livre/index.png" ISBN="" style="padding: 0;height: 240px"> 
        </div>
        <!-- Card content -->
        <div class="card-body card-body-cascade text-center">
        <!-- Text -->
        <div class="card-text"> voir plus</div>
            <hr class="shine heroShine " >
        </div>
    </div>
  </a>
</div>
END;

        }
        //liste des heros

        $herosCont=VueFactory::listeHeros($listeHeros,"../",'HeroDetail',$app);

        $herosCont.=$seemore;
        //COMICS
        //*************************************************************************************************************
        $listeComics=$this->content["listeComics"];
        $seemore="";
        if(sizeof($listeComics)>11){
           $listeComics= $listeComics->take(11);
/*
 *             <div class="col-lg-2 containerListButton" >
                <a href="$url">
                    <img class="col-lg-12" src="../theme/ressources/livre/index.png" ISBN="" style="padding: 0;height: 240px">
                </a>
            </div>
 */
            $url = $app->urlFor('seachDetailComics', ["content" =>$chianeSearch ]);
            $seemore=<<<END


<div class="col-lg-2 card-containerSearch">
  <div class="card-body">
    <h2>Voir plus</h2>
    </div><!-- /.card-body -->
</div>
END;
        }
        //list Comics
        $comicsCont=VueFactory::listComics($listeComics,"../",$app);
        $comicsCont.=$seemore;

        //COMICS FIN
        //*************************************************************************************************************

        return $html=<<<END
                <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row " style="padding: 0">
                         <h1 class="sectionTitle">Héros</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>   
                        <section class=" col-12 row">
                             $herosCont
                        </section>
                    </div>
                </div>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row  " style="padding: 0">
                         <h1 class="sectionTitle">Série</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>   
                        <section class=" col-12 row">
                             $serieCont
                        </section>
                    </div>
                </div>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row catalogue" style="padding: 0">
                        <h1 class="sectionTitle">Comics</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>   
                        <section class=" col-12 row">
                             $comicsCont
                        </section>
                    </div>
                </div>
            </main>
        </div>
END;

    }
    //Case 1
    function rechercherHeros($app){

        $chianeSearch=$this->content["chianeSearch"];
        $urlBack=$app->urlFor('Search', ["content" => $chianeSearch]);
        $listeHeros=$this->content["listeHeros"];
        $herosCont=VueFactory::listeHeros($listeHeros,"../",'HeroDetail',$app);

        return $html=<<<END
                <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <a href="$urlBack">retour <- </a>
                <div class="row">
                    <h1 class="sectionTitle">Héros</h1>
                        <span class=" container sectionWatchers"></span>   
                </div>
                <div class=" row">    
                   $herosCont
                </div>
            </main>
        </div>
END;


    }

    //case 2
    function rechercherSeries($app){
        $chianeSearch=$this->content["chianeSearch"];
        $urlBack=$app->urlFor('Search', ["content" => $chianeSearch]);
        $listeSerie=$this->content["listeSerie"];
        $serieCont=VueFactory::listeSerie($listeSerie,$app);
        return $html=<<<END
                <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
            <a href="$urlBack">retour <- </a>
                <div class="row">
                    <h1 class="sectionTitle">Série</h1>
                    <span class=" container sectionWatchers"></span>   
                </div>
                <div class=" row">    
                   $serieCont
                </div>
            </main>
        </div>
END;

    }

    //case 3
    function rechercherComics($app){
        $chianeSearch=$this->content["chianeSearch"];
        $urlBack=$app->urlFor('Search', ["content" => $chianeSearch]);
        $listeComics=$this->content["listeComics"];
        $comicsCont=VueFactory::listComics($listeComics,"../",$app);

        return $html=<<<END
                <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <a href="$urlBack">retour <- </a>
                <div class="row">
                    <h1 class="sectionTitle">Comics</h1>
                    <span class=" container sectionWatchers"></span> 
                </div>
                <div class=" row">    
                   $comicsCont
                </div>
            </main>
        </div>
END;


    }




}