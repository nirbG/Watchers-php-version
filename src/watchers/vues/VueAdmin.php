<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/09/2018
 * Time: 21:42
 */

namespace watchers\vues;


use watchers\models\Livre;

class VueAdmin
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
        $urlH = $app->urlFor("Heros", ["nbP" => 1]);
        $urlAllC = $app->urlFor("Collection");
        $urlALLCH = $app->urlFor("CollectionHeros");
        $urlALLCS = $app->urlFor("CollectionSerie");
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
                $cont = $this->adminHome($app);
                $js = <<<END
END;
                break;
            case 1:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->listHerosMod($app);
                $js = <<<END
END;
                break;
            case 2:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->listSerieMod($app);
                $js = <<<END
END;
                break;
            case 3:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->listComicsMod($app);
                $js = <<<END
                <script type='text/javascript' src='../theme/js/add.js'></script>
                <script type='text/javascript' src='../theme/js/suppCo.js'></script>
END;
                break;
            case 4:
                $theme = "../../theme";
                $bootstrap = "../../bootstrap";
                $MDB = "../../MDB";
                $cont = $this->detailModLivre($app);
                $js = <<<END
                <script type='text/javascript' src='$theme/js/imgFormAdmin.js'></script>
                <script type='text/javascript' src='$theme/js/formUpdCo.js'></script>
          
END;
                break;
            case 5:
                $theme = "../../theme";
                $bootstrap = "../../bootstrap";
                $MDB = "../../MDB";
                $cont = $this->detailModSerie($app);
                $js = <<<END
                <script type='text/javascript' src='$theme/js/formUpdSe.js'></script>
END;
                break;
            case 6:
                $theme = "../../theme";
                $bootstrap = "../../bootstrap";
                $MDB = "../../MDB";
                $cont = $this->detailModHero($app);
                $js = <<<END
                
                <script type='text/javascript' src='$theme/js/formUpdHe.js'></script>
                <script type='text/javascript' src='$theme/js/imgFormAdmin.js'></script>
          
END;
            break;
            case 7:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->newHero($app);
                $js = <<<END
                <script type='text/javascript' src='$theme/js/formCreHe.js'></script>
                <script type='text/javascript' src='$theme/js/imgFormAdmin.js'></script>
END;
                break;
            case 8:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->newSerie($app);
                $js = <<<END
                <script type='text/javascript' src='$theme/js/formCreSe.js'></script>
END;
                break;
            case 9:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->newComics($app);
                $js = <<<END
                <script type='text/javascript' src='$theme/js/imgFormAdmin.js'></script>
                <script type='text/javascript' src='$theme/js/formCreCo.js'></script>

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
         <script type='text/javascript' src='$MDB/js/mdb.min.js'></script>
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

    public function adminHome($app){
        $liste1=$this->createCard("Liste Héros",$app->urlFor("listHeros"),"comics.png");
        $liste2=$this->createCard("Liste Série",$app->urlFor("listSeries"),"comics.png");
        $liste3=$this->createCard("Liste Comics",$app->urlFor("listComics"),"comics.png");
        $add1=$this->createCard("Add Heros",$app->urlFor("newHero"),"comics.png");
        $add2=$this->createCard("Add Serie",$app->urlFor("newSerie"),"comics.png");
        $add3=$this->createCard("Add Comics",$app->urlFor("newComics"),"comics.png");
        return $html=<<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Menu Admin</h1>
                    <span class=" container sectionWatchers"></span>   
                </div>
                <div class=" row">    
                   <div class="col-6  " >
                        <h1 style="background-color: white">List</h1>
                        $liste1
                        $liste2
                        $liste3
                   </div>
                   <div  class="col-6 ">
                        <h1 style="background-color: white">Ajout</h1>
                        $add1
                        $add2
                        $add3
                   </div>
                </div>
            </main>
        </div>
END;
    }

    function listHerosMod($app){
        $urlBack=$app->urlFor('adminHome');
        $listeHeros=$this->content;
        $herosCont=$this->listHeros($listeHeros,"../theme",$app);
        return $html= <<<END
        <div class="marginTBB container">
            <button type="button" onclick="location.href='$urlBack';" class="btn Watchersbtn" style="margin: 15px -15px;"><i class="fas fa-reply"></i> Retour</button>   
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Heros</h1>
                    <span class=" container sectionWatchers"></span>
                </div>
                <div class=" row">    
                   $herosCont
                </div>
            </main>
        </div>
END;
    }
    function listSerieMod($app){
        $urlBack=$app->urlFor('adminHome');
        $listeSerie=$this->content;
        $serieCont=$this->listSerie($listeSerie,$app);
        return $html=<<<END
        <div class="marginTBB container">
            <button type="button" onclick="location.href='$urlBack';" class="btn Watchersbtn" style="margin: 15px -15px;"><i class="fas fa-reply"></i> Retour</button>   
            <main role="main" class="inner cover" style="padding: 0">
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
    function listComicsMod($app){
        $urlBack=$app->urlFor('adminHome');
        $listeComics=$this->content;
        $comicsCont=$this->listComics($listeComics,$app);
        return $html=<<<END
        <div class="marginTBB container">
            <button type="button" onclick="location.href='$urlBack';" class="btn Watchersbtn" style="margin: 15px -15px;"><i class="fas fa-reply"></i> Retour</button>   
            <main role="main" class="inner cover" style="padding: 0">
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



    public function createCard($name,$url,$img){
        return $html=<<<END
                        <div class="card" style="width: inherit;">
                            <div class="view overlay">
                                <img class="card-img-top" style="max-height: 100px" src="../theme/ressources/livre/$img" alt="Card image cap">
                                <div class="mask rgba-white-slight"></div>
                            </div>
                            
                            <a href="$url" style="position: absolute;height: 100px;width: 100%">
                            <div class="card-body"style="height: 100px;width: 100%" >
                                <h4 class="card-title " style="color: white;text-shadow: 2px 2px 4px #000000;">$name</h4>
                            </div> 
                            </a>
                        </div>
END;

    }

    /*
 * UTILS
 */
    function listComics($liste,$app) {

        $comicsCont="";
        foreach ($liste as $c) {
            $env = "<button class='btn btnMinus col-12'><i class='fas fa-minus'></i></button>";
            $url = $app->urlFor('livreMOD', ["ISBN" => $c->ISBN]);
            $img ="../theme/ressources/livre/$c->img";
            $rating = VueFactory::rating($c);
            $comicsCont .= <<<END


<div class="col-lg-2 card-containerSearch" style="background: url($img) center no-repeat;background-size: 100% 100%;" ISBN="$c->ISBN" >
  <div class="card-body" style="text-align: center;padding: 50px 0px;">
        $rating
        <div class="">
        <a href="$url"><button class="btn btnInfo  col-12 "><i class="fas fa-info"></i></i></button></a>
        $env
        </div>
    </div><!-- /.card-body -->
</div>
            

END;
        }
        return $comicsCont;
    }

    function listSerie($liste,$app) {
        $serieCont="";
        $livre=new Livre();
        foreach ($liste as $s){
            $url = $app->urlFor('serieMOD', ["id" => $s->id]);
            $numberComics=$livre->mySeriesnumber($s->id);
            $complet="serieNONComplete";
            if($numberComics==$s->nblivre){
                $complet="serieComplete";
            }
            $serieCont .= <<<END
            <div class=" serie card  col-lg-12" style="padding: 0">
                <a href="$url">
                <h5 class="col-12" style="margin: 1% 0%;color: black">$s->nom<strong class="$complet" >$numberComics/$s->nblivre</strong></h5>
                </a>
            </div>
END;
        }
        return $serieCont;
    }

    function listHeros($liste,$chemin,$app){
        $herosCont="";
        foreach ($liste as $h) {
            $url = $app->urlFor('heroMOD', ["id" => $h->id]);
            $herosCont .= <<<END
<!-- Card -->
<div class=" col-2 card-cascade heroCatalogue" >
  <a href="$url" class="heroCatalogue" >
    <div class="hero">
    <!-- Card image -->
        <div class="view view-cascade gradient-card-header blue-gradient" style="padding: 0">
            <img class="col-lg-12 heroImg" src="$chemin/ressources/heros/$h->img" >
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


    function detailModLivre($app){
        $book=$this->content[0];

        $deleteComics = $app->urlFor("suppComicsget", ["ISBN" => $book->ISBN]);
        $heros=$this->content[1];
        $urlUpdate=$app->urlFor('updatelivre', ["ISBN" => $book->ISBN]);
        $revue="";
        $cartone="";
        if($book->Format=="Revue"){
            $revue="checked";
        }else{
            $cartone="checked";
        }
        $cont="";
        foreach ($heros as $h){
            $env="<button class='btn btnMinus col-12'><i class='fas fa-minus'></i></button>";
            $url=$app->urlFor('heroMOD', ["id" => $h->id]);
            $img="../../theme/ressources/heros/$h->img";
            $rating=" <div class='overflow'  title='".$h->nom."'>$h->nom</div>";
            $cont.=<<<END
<div class="col-lg-2 card-containerSearch" style="background: url($img) center no-repeat;background-size: 100% 100%;" heros="$h->id" >
  <div class="card-body" style="text-align: center;padding: 50px 0px;">
        $rating
        <div class="">
        <a href="$url"><button class="btn btnInfo col-12 "><i class="fas fa-info"></i></i></button></a>
        $env
        </div>
    </div><!-- /.card-body -->
</div>
            

END;
        }


        return <<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Comics</h1>
                    <span class=" container sectionWatchers"><i id="supprimerEvenement"  data-toggle="modal" data-target="#modalQuitter" style="margin: 10px 0;" class="fas fa-2x fa-trash-alt"></i></span>    
                </div>  
                <form class="row" onsubmit="return FormCre.module.submit.start()"   method="post" enctype="multipart/form-data" action="$urlUpdate">
                    <input class="idComics" type="hidden" idComics="$book->ISBN">
                    <div class="col-md-5" style="text-align: center">
                         <div id="prev" >
                             <img id="imgU" src="../../theme/ressources/livre/$book->img" style="max-height: 400px;max-width: 400px;" >
                         </div>
                         <input id="imgI" class="col-sm-12" type="file" name="img"  accept="image/*" style="color: black;overflow: hidden;">
                    </div>	
                    <div id="mymodalupdatecompte" class="col-md-7 row " style="color: black;text-align: left" >
                         <div class="col-md-6 form-group">
                             <p>ISBN *</p>
                             <input class="col-lg-12" ISBN="$book->ISBN" name="ISBN" value="$book->ISBN" id="ISBN" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un ISBN.</span>
                         </div>          
                         <div class="col-md-6 form-group">
                             <p>EAN *</p>
                             <input class="col-lg-12" name="EAN" value="$book->EAN" id="EAN" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un EAN.</span>
                         </div>
                         <div class="col-md-6">
                             <p>Titre * </p>
                             <input class="col-lg-12" name="titre" value="$book->titre" id="titre" type="text" style="color: black">
                         </div>
                         <div class="col-md-6" >
						     <p>Format </p>
					         <div class="form-group row">
						        <div class="radio col-6">
						            <label><input type="radio" name="format" value="Revue" $revue checked>Revue</label>
						        </div>
						        <div class="radio col-6">
						            <label><input type="radio" name="format" value="Cartoné" $cartone>Cartoné</label>
						        </div>
					        </div>
			             </div>
			             <div class="col-md-6">
                             <p>Editeur </p>
                             <input class="col-lg-12" name="editeur" value="$book->Editeur" id="editeur" type="text" style="color: black">
                         </div>
                          <div class="col-md-6">
						    <div class="form-group">
							    <p>Date  *</p>
                                <input class="col-lg-12" id="date" name="date" type="date"  value="$book->date"  style="color: black">
                                <span class="help-block">Veuillez saisir une date superieur à la date actuelle.</span>
							</div>
							
						 </div>
                         <div class="row">
                            <ul>
                                <li>
                                    <p  id="addHero" style="width:100%;padding: 3% 0%;margin-top: 2rem;">Modifier son héros ou vilain</p href="">
                                </li>
                             
                                <li>
                                <a href="" class="   " style="width:100%;padding: 3% 0%;margin-top: 2rem;">Modifier l'appartence à une serie</a href="">
                                </li>
                            </ul>
                         </div>
                         <div class="col-md-12" style="text-align: center">
                             <button id="valider" role="button" type="submit" class=" col-sm-4 Watchersbtn btn btn-light-blue btn-lg ">Valider</button>
                             <button id="cancelUpdate" type="button" class=" col-sm-4 Watchersbtn btn btn-light-blue btn-lg ">Annuler</button>
                          </div>
                    </div>
                </form>
                <div class="col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row " style="padding: 0">
                        <h1 class="sectionTitle">les héros lié aux comics</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>
                        <section class=" col-12 row">
                            $cont
                        </section>
                    </div>
                </div>
            </main>
        </div>
        <div id="myInvitModal" class="modal myInvitEventD">
            <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="text-align: left">Ajouter des membres à l'événement:</h2>
                        <button id="closeInvitModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 500px;overflow-y : scroll;">
                        <header class="page-header">
                            <div class="comics">
                                veuillez rentrer un pseudo
                                <input id="comicsinput" style="color:black" type="text">
                                <fieldset class="row ">
                            </fieldset>
                        </di>
                    </header>
                </div>
                 <div class="modal-footer">
                </div>
            </div>          
        </div>
        <div id="modalQuitter" class="modal" tabindex="-1" role="dialog" data-backdrop="false">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title">Suprimer le comics</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                 <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
                        <p>Êtes-vous sur de vouloir supprimer ce Comics ?</p>
			            <button type="button" onclick="location.href='$deleteComics';" class="btn btnchoose">Confirmer</button>
				        <button type="button" class="btn btnchoose" data-dismiss="modal">Annuler</button>
				    </div>
				<div class="modal-footer">
			    </div>
		        </div>
	        </div>
		</div>
END;

    }


    function detailModSerie($app){
        $book=$this->content["comics"];
        $comicsCont="";
        foreach ($book as $c){
            $env="<button class='btn btnMinus col-12'><i class='fas fa-minus'></i></button>";
            $url=$app->urlFor('livreMOD', ["ISBN" => $c->ISBN]);
            $img="../../theme/ressources/livre/$c->img";
            $rating=VueFactory::rating($c);
            $comicsCont.=<<<END
<div class="col-lg-2 card-containerSearch" style="background: url($img) center no-repeat;background-size: 100% 100%;" ISBN="$c->ISBN" >
  <div class="card-body" style="text-align: center;padding: 50px 0px;">
        $rating
        <div class="">
        <a href="$url"><button class="btn btnInfo col-12 "><i class="fas fa-info"></i></i></button></a>
        $env
        </div>
    </div><!-- /.card-body -->
</div>
            

END;
        }
        $serie=$this->content["serie"];

        $deleteSerie = $app->urlFor("suppSerieget", ["id" => $serie->id]);
        $urlUpdate=$app->urlFor('updateSerie', ["id" => $serie->id]);
        return <<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Admin Série</h1>
                    <span class=" container sectionWatchers"><i id="supprimerEvenement"  data-toggle="modal" data-target="#modalQuitter" style="margin: 10px 0;" class="fas fa-2x fa-trash-alt"></i></span>     
                </div>  
                <form class="row" onsubmit="return FormCre.module.submit.start()"   method="post" enctype="multipart/form-data" action="$urlUpdate">
                    <div id="mymodalupdatecompte" class="col-md-12 row" style="color: black;text-align: left" >
                         <div>
                         <input class="idSerie" type="hidden" idSerie="$serie->id">
                         </div>
                         <div class="col-md-6 form-group">
                             <p>NOM *</p>
                             <input class="col-md-12" name="nom" value="$serie->nom" id="nom" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un nom.</span>
                         </div>   
                          <div class="col-md-6" style="text-align: center">
                             <button id="valider" role="button" type="submit" class=" col-sm-6 Watchersbtn btn btn-light-blue btn-lg " style="float: right">Valider</button>
                          </div>
                    </div>
                </form>
                <p id="addComics">add comics</p>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row " style="padding: 0">
                        <h1 class="sectionTitle">Modifier les comics de la série</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>
                        <section class=" col-12 row">
                            $comicsCont
                        </section>
                    </div>
                </div>
            </main>
        </div>
        <div id="myInvitModal" class="modal myInvitEventD">
            <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="text-align: left">Ajouter des membres à l'événement:</h2>
                        <button id="closeInvitModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 500px;overflow-y : scroll;">
                        <header class="page-header">
                            <div class="comics">
                                veuillez rentrer un pseudo
                                <input id="comicsinput" style="color:black" type="text">
                                <fieldset class="row ">
                            </fieldset>
                        </di>
                    </header>
                </div>
                 <div class="modal-footer">
                </div>
            </div>          
        </div>
        <div id="modalQuitter" class="modal" tabindex="-1" role="dialog" data-backdrop="false">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title">Suprimer la série</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                 <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
                        <p>Êtes-vous sur de vouloir supprimer cette série ?</p>
			            <button type="button" onclick="location.href='$deleteSerie';" class="btn btnchoose">Confirmer</button>
				        <button type="button" class="btn btnchoose " data-dismiss="modal">Annuler</button>
				    </div>
				<div class="modal-footer">
			    </div>
		        </div>
	        </div>
		</div>
END;

    }

    function detailModHero($app){
        $hero=$this->content["hero"];
        $book=$this->content["comics"];
        $comicsCont="";
        foreach ($book as $c){
            $lie=$c->isLieeBySerie($hero->id);
            $env="";
            if($lie) {
                $env = "<button class='btn btnMinus col-12'><i class='fas fa-minus'></i></button>";
            }
            $url=$app->urlFor('livreMOD', ["ISBN" => $c->ISBN]);
            $img="../../theme/ressources/livre/$c->img";
            $rating=VueFactory::rating($c);
            $comicsCont.=<<<END
<div class="col-lg-2 card-containerSearch" style="background: url($img) center no-repeat;background-size: 100% 100%;" ISBN="$c->ISBN" >
  <div class="card-body" style="text-align: center;padding: 50px 0px;">
        $rating
        <div class="">
        <a href="$url"><button class="btn btnInfo col-12 "><i class="fas fa-info"></i></i></button></a>
        $env
        </div>
    </div><!-- /.card-body -->
</div>
END;
        }
        $img="../../theme/ressources/livre/index.png";
        $comicsCont.=<<<END
<div id="addComics" class="col-lg-2 card-containerSearch " style="background: url($img) center no-repeat;background-size: 100% 100%;"  >
  <div class="card-body" style="text-align: center;padding: 50px 0px;">
        <div class="" >
           <p style="color: white!important;">add</p>
           <p style="color: white!important;">Comics</p>
        </div>
    </div><!-- /.card-body -->
</div>
END;
        $serie=$this->content["series"];

        $serieCont="";
        foreach ($serie as $s){
            $url =$app->urlFor('serieMOD', ["id" => $s->id]);
            $serieCont .= <<<END
            <div class=" serie card  col-lg-12" idSe="$s->id" style="padding: 0">
                <div class="row col-12">
                <i class="col-1 supprimerSerie fas  fa-trash-alt" style="margin: 1% 0%;"></i>
                <a class="col-11" href="$url">
                    <h5 class="" style="margin: 1% 0%;color: black"> $s->nom<strong class="serieNONComplete" >$s->nblivre</strong></h5>
                </a>
               
                </div>
            </div>
END;
        }
        $serieCont.=<<<END
            <div class=" serie card  col-lg-12" style="padding: 0;text-align: center">
                <h5 id="addSerie" class="col-12" style="margin: 1% 0%;color: black"><i class="fas fa-plus"></i></h5>
            </div>
END;

        $deleteHeros=$app->urlFor("suppHeroget", ["id" => $hero->id]);;
        $urlUpdate=$app->urlFor('updateHero', ["id" => $hero->id]);
        return <<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Admin héros</h1>
                    <span class=" container sectionWatchers"><i id="supprimerEvenement"  data-toggle="modal" data-target="#modalQuitter" style="margin: 10px 0;" class="fas fa-2x fa-trash-alt"></i></span>     
                </div>    
                <form class="row" onsubmit="return FormCre.module.submit.start()"  method="post" enctype="multipart/form-data" action="$urlUpdate">
                    <div id="mymodalupdatecompte" class="col-md-12 row" style="color: black;text-align: left" >
                        <input id="idHeros" type="hidden" idHeros="$hero->id"> 
                        <div class="col-md-5" style="text-align: center">
                            <div id="prev" >
                                <img id="imgU" src="../../theme/ressources/heros/$hero->img" style="max-height: 300px;max-width: 300px;" >
                            </div>
                            <input id="imgI" class="col-sm-12" type="file" name="img"  accept="image/*" style="color: black;overflow: hidden;">
                        </div>	
                        <div class="col-md-6 form-group">
                             <p>NOM *</p>
                             <input class="col-md-12" name="nom" value="$hero->nom" id="nom" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un nom.</span>
                             <p>Principaux pouvoir </p>
                             <input class="col-md-12" name="Pouvoir" value="$hero->pouvoir" id="Pouvoir" type="text" style="color: black">
                             <p>description</p>
                             <textarea  class="col-md-12" rows="5" name="desc" style="color: black">
                                $hero->desc
                             </textarea>
                        </div> 
                        <div class="col-md-5" style="text-align: center">
                            <div id="prev2" >
                                <img id="imgUL" src="../../theme/ressources/logo/$hero->Logo" style="max-height: 200px;max-width: 200px;" >
                            </div>
                            <input id="imgI2" class="col-sm-12" type="file" name="logo"  accept="image/*" style="color: black;overflow: hidden;">
                        </div>	
                        <div class="col-md-6 ">
                             <p>UNIVERS</p>
                             <input class="col-md-12" name="Univers" value="$hero->Univers" id="Univers" type="text" style="color: black">
                            <button id="valider" role="button" type="submit" class=" col-sm-12 Watchersbtn btn btn-light-blue btn-lg " style="float: right">Valider</button>
                        </div>
                    </div>
                </form>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row " style="padding: 0">
                        <h1 class="sectionTitle">Modifier ses serie</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>
                        <section class=" col-12 row">
                            $serieCont
                        </section>
                    </div>
                </div>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row " style="padding: 0">
                        <h1 class="sectionTitle">modifier ou ajouter des alliés</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>
                        <section class=" col-12 row">
                            $comicsCont
                        </section>
                    </div>
                </div>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row " style="padding: 0">
                        <h1 class="sectionTitle">modifier ou ajouter des enemis</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>
                        <section class=" col-12 row">
                            $comicsCont
                        </section>
                    </div>
                </div>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row " style="padding: 0">
                        <h1 class="sectionTitle">modifier ou ajouter des equipe</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span>
                        <section class=" col-12 row">
                            $comicsCont
                        </section>
                    </div>
                </div>
                <div class=" col-12" style="padding-right: 0; padding-top: 25px">
                    <div class="row catalogue " style="padding: 0">
                        <h1 class="sectionTitle" >Modifier ses comics </h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus   " style=""></i></span>
                        <section class=" col-12 row">
                            $comicsCont
                        </section>
                    </div>
                </div>
            </main>
        </div>
        <div id="myInvitModal" class="modal myInvitEventD">
            <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="text-align: left">Ajouter des séries au heros:</h2>
                        <button id="closeInvitModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 500px;overflow-y : scroll;">
                        <header class="page-header">
                            <div class="serie">
                                veuillez rentrer une chaine
                                <input id="seriesinput" style="color:black" type="text">
                                <fieldset class="row ">
                            </fieldset>
                        </di>
                    </header>
                </div>
                 <div class="modal-footer">
                </div>
            </div>          
        </div>
        <div id="myInvitModal2" class="modal myInvitEventD">
            <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="text-align: left">Ajouter des comics au heros:</h2>
                        <button id="closeInvitModalI" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 500px;overflow-y : scroll;">
                        <header class="page-header">
                            <div class="comics">
                                veuillez rentrer un titre
                                <input id="comicsinput" style="color:black" type="text">
                                <fieldset class="row ">
                            </fieldset>
                        </di>
                    </header>
                </div>
                 <div class="modal-footer">
                </div>
            </div>          
        </div>
        <div id="modalQuitter" class="modal" tabindex="-1" role="dialog" data-backdrop="false">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title">Suprimer le héros</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                 <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
                        <p>Êtes-vous sur de vouloir supprimer ce héros ?</p>
			            <button type="button" onclick="location.href='$deleteHeros';" class="btn btnchoose">Confirmer</button>
				        <button type="button" class="btn btnchoose" data-dismiss="modal">Annuler</button>
				    </div>
				<div class="modal-footer">
			    </div>
		        </div>
	        </div>
		</div>
        <div id='modalQuitter2' class='modal2 modal myInvitEventD' tabindex='-1' role='dialog' data-backdrop='false'>
        </div>
END;
    }


    function newHero($app){
        $urlAdd=$app->urlFor('addHero');
        return <<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                     <h1 class="sectionTitle">Heros</h1>
                     <span class=" container sectionWatchers"></span>  
                </div>  
                <form class="row" onsubmit="return FormCre.module.submit.start()"   method="post" enctype="multipart/form-data" action="$urlAdd">
                    <div id="mymodalupdatecompte" class="col-md-12 row" style="color: black;text-align: left" >
                        <div class="col-md-5" style="text-align: center">
                            <div id="prev" >
                                <img id="imgU" src="../theme/ressources/heros/heros.jpg" style="max-height: 300px;max-width: 300px;" >
                            </div>
                            <input id="imgI" class="col-sm-12" type="file" name="img"  accept="image/*" style="color: black;overflow: hidden;">
                        </div>	
                        <div class="col-md-6 form-group">
                             <p>NOM *</p>
                             <input class="col-md-12" name="nom" value="" id="nom" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un nom.</span>
                             <p>Principaux pouvoir </p>
                             <input class="col-md-12" name="Pouvoir" value="" id="Pouvoir" type="text" style="color: black">
                             <p>description</p>
                             <textarea  class="col-md-12" rows="5" name="desc" style="color: black">
                             </textarea>
                        </div> 
                        <div class="col-md-5" style="text-align: center">
                            <div id="prev2" >
                                <img id="imgUL" src="../theme/ressources/logo/logo.png" style="max-height: 200px;max-width: 200px;" >
                            </div>
                            <input id="imgI2" class="col-sm-12" type="file" name="logo"  accept="image/*" style="color: black;overflow: hidden;">
                        </div>	
                        <div class="col-md-6 ">
                             <p>UNIVERS </p>
                             <input class="col-md-12" name="Univers" value="" id="Univers" type="text" style="color: black">
                             <button id="valider" role="button" type="submit" class=" col-sm-12 Watchersbtn btn btn-light-blue btn-lg " style="float: right">Valider</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
END;
    }



    function newSerie($app){

        $urlUpdate=$app->urlFor('addSerie');
        return <<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Série</h1>
                    <span class=" container sectionWatchers"></span>
                </div>  
                <form class="row" onsubmit="return FormCre.module.submit.start()"   method="post" enctype="multipart/form-data" action="$urlUpdate">
                    <div id="mymodalupdatecompte" class="col-md-12 row" style="color: black;text-align: left" >
                         <div class="col-md-6 form-group ">
                             <p>NOM *</p>
                             <input class="col-md-12" name="nom" value="" id="nom" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un nom.</span>
                         </div>   
                          <div class="col-md-6" style="text-align: center">
                             <button id="valider" role="button" type="submit" class=" col-sm-6 Watchersbtn btn btn-light-blue btn-lg " style="float: right">Valider</button>
                          </div>
                    </div>
                </form>
            </main>
        </div>
END;

    }


    function newComics($app){

        $urlUpdate=$app->urlFor('addComics');
        return <<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">                    
                    <h1 class="sectionTitle">Comics</h1>
                    <span class=" container sectionWatchers"></span>
                </div>  
                <form class="row" onsubmit="return FormCre.module.submit.start()"   method="post" enctype="multipart/form-data" action="$urlUpdate">
                <form class="row" onsubmit="return FormCre.module.submit.start()"   method="post" enctype="multipart/form-data" action="$urlUpdate">
                    <div class="col-md-5" style="text-align: center">
                         <div id="prev" >
                             <img id="imgU" src="../theme/ressources/livre/comics.jpg" style="max-height: 400px;max-width: 400px;" >
                         </div>
                         <input id="imgI" class="col-sm-12" type="file" name="img"  accept="image/*" style="color: black;overflow: hidden;">
                    </div>	
                    <div id="mymodalupdatecompte" class="col-md-7 row " style="color: black;text-align: left" >
                         <div class="col-md-6 form-group">
                             <p>ISBN *</p>
                             <input class="col-lg-12" name="ISBN" value="" id="ISBN" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un ISBN.</span>
                         </div>          
                         <div class="col-md-6 form-group">
                             <p>EAN *</p>
                             <input class="col-lg-12" name="EAN" value="" id="EAN" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un EAN.</span>
                         </div>
                         <div class="col-md-6 form-group">
                             <p>Titre * </p>
                             <input class="col-lg-12" name="titre" value="" id="titre" type="text" style="color: black">
                             <span class="help-block">Veuillez saisir un titre.</span>
                         </div>
                         <div class="col-md-6" >
						     <label>Format </label>
					         <div class="form-group row">
						        <div class="radio col-6">
						            <label><input type="radio" name="format" value="Revue" checked>Revue</label>
						        </div>
						        <div class="radio col-6">
						            <label><input type="radio" name="format" value="Cartoné">Cartoné</label>
						        </div>
					        </div>
			             </div>
			             <div class="col-md-6">
                             <p>Editeur </p>
                             <input class="col-lg-12" name="editeur" value="" id="editeur" type="text" style="color: black">
                         </div>
                         <div class="col-md-6">
						    <div class="form-group">
							    <label>Date  *</label>
                                <input id="date" name="date" type="date"  value=""  style="color: black">
                                <span class="help-block">Veuillez saisir une date superieur à la date actuelle.</span>
							</div>
							
						 </div>
                         <div class="col-md-12" style="text-align: center">
                             <button id="valider" role="button" type="submit" class=" col-sm-5 Watchersbtn btn btn-light-blue btn-lg ">Valider</button>
                             <button id="cancelUpdate" type="button" class=" col-sm-5 Watchersbtn btn btn-light-blue btn-lg ">Annuler</button>
                          </div>
                    </div>
                </form>
            </main>
        </div>
END;
    }
}