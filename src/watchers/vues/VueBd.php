<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16/08/2018
 * Time: 12:24
 */

namespace watchers\vues;


use watchers\models\Heros;

class VueBd
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
        //initialisatio
        switch ($id) {
            case 0:
                $cont = $this->accueil($app);
                $bd = "active";
                $label="[";
                $data="[";
                $Chart1=$this->content["chart 1"];
                $i=4;
                while($i>=0){
                    $label.="'".$this->getmounth($Chart1[$i]["month"])."',";
                    $data.=$Chart1[$i]["nbl"].",";
                    $i--;
                }
                $label.="]";
                $data.="]";
                $label2="[";
                $data2="[";
                $Chart2=$this->content["chart 2"];
                $i= sizeof($Chart2)-1;
                while($i>=0){
                    $label2.="'".$Chart2[$i]["Univers"]."',";
                    $data2.=$Chart2[$i]["count(*)"].",";
                    $i--;
                }
                $label2.="]";
                $data2.="]";
                $label3="[";
                $data3="[";
                $Chart3=$this->content["chart 3"];
                $i= sizeof($Chart3)-1;
                foreach ($Chart3 as $ch3){
                    $h3=$ch3["heros"];
                    $label3.="'".$h3->nom."',";
                    $data3.=$ch3["nbl"].",";
                }
                $label3.="]";
                $data3.="]";
                $label5="";
                $data5="";
                $Chart5=$this->content["chart 5"];
                foreach ($Chart5 as $ch5){
                    $label5.="'".$ch5->sNom."',";
                    $data5.=$ch5->numberComics.",";
                }
                $label4="[ 'albumManquant', 'album dans ta collection' ]";
                $data4="[".$this->content["booksSerieTotal"].",".$this->content["booksSerie"]."]";

                $js= <<<END
                <script type='text/javascript' src='theme/js/modalUpCompte.js'></script>
                <script type='text/javascript' src='theme/js/supp.js'></script>
    <script>
  var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
        labels: $label,
        datasets: [
            {
                label: "recap achat",
                backgroundColor : "rgba(0,0,0,0.8)",
                borderWidth : 2,
                borderColor : "rgba(116,15,0,1)",
                pointBackgroundColor : "rgba(116,15,0,1)",
                pointBorderColor : "rgba(116,15,0,1)",
                pointBorderWidth : 1,
                pointRadius : 4,
                pointHoverBackgroundColor : "#fff",
                pointHoverBorderColor : "rgba(116,15,0,1)",
                data: $data
            }
        ]
    },
    options: {
        responsive: true
    }
    });
    </script>
    <script>
    //pie
var ctxP = document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: $label3,
        datasets: [
            {
                data: $data3,
                backgroundColor: ["#F62100","#C31A00", "#8F1300","#600D00", "#400900"],
                hoverBackgroundColor: ["#F55200", "#C24100", "#8F3000",  "#5C1F00","#401500"]
            }
        ]
    },
    options: {
        responsive: true
    }
});
    </script>
    <script>
    //polar
var ctxPA = document.getElementById("polarChart").getContext('2d');
var myPolarChart = new Chart(ctxPA, {
    type: 'polarArea',
    data: {
        labels: $label2,
        datasets: [
            {
                data: $data2,
                backgroundColor: ["rgba(219, 0, 0, 0.1)", "rgba(0, 165, 2, 0.1)", "rgba(255, 195, 15, 0.2)", "rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.3)"],
                hoverBackgroundColor: ["rgba(219, 0, 0, 0.2)", "rgba(0, 165, 2, 0.2)", "rgba(255, 195, 15, 0.3)", "rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.4)"]
            }
        ]
    },
    options: {
        responsive: true
    }
});
</script>
<script>
var ctxP = document.getElementById("pieChart2").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: $label4 ,
        datasets: [
            {
                data: $data4 ,
                backgroundColor: ["#740f00","#000000"],
                hoverBackgroundColor: ["#861100", "#0c0600"]
            }
        ]
    },
    options: {
        responsive: true
    }
});
    </script>
    <script>
    //bar
var ctxB = document.getElementById("barChart").getContext('2d');
var myBarChart = new Chart(ctxB, {
  type: 'bar',
  data: {
    labels: [$label5],
    datasets: [{
      label: '# of comics',
      data: [$data5],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
   options: {
        scales: {
            xAxes: [{
                ticks: {
                    display: false //this will remove only the label
                }
            }]
        }
    }
});
    </script>
END;
                $footer=VueFactory::footer(false,$theme,$app);
                break;
            case 1:
                $cont = $this->heros($app);
                $h = "active";
                $js=<<<END
END;
                $footer=VueFactory::footer(false,$theme,$app);
                break;
            case 2:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->heroD($app);
                $h = "active";

                $footer=VueFactory::footer(true,$theme,$app);
                $js=<<<END
                    <script type='text/javascript' src='../theme/js/add.js'></script>
END;
                break;
            case 3:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->serieD($app);
                $h = "active";
                $label4="[ 'albumManquant', 'album dans ta collection' ]";
                $data4="[3,2]";
                $footer=VueFactory::footer(false,$theme,$app);
                $js=<<<END
                    <script type='text/javascript' src='../theme/js/serieDetail.js'></script>
                    <script type='text/javascript' src='../theme/js/add.js'></script>
<script>
var ctxP = document.getElementById("pieChart2").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: $label4 ,
        datasets: [
            {
                data: $data4 ,
                backgroundColor: ["#740f00","#000000"],
                hoverBackgroundColor: ["#861100", "#0c0600"]
            }
        ]
    },
    options: {
        responsive: true
    }
});
    </script>
END;
                break;
            case 4:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->livreD($app);
                $h = "active";
                $footer=VueFactory::footer(false,$theme,$app);
                $js=<<<end
                <script type='text/javascript' src='../theme/js/comicsdetail.js'></script>
                <script type='text/javascript' src='../theme/js/commentaire.js'></script>
                <script>
                
$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
    
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>
end;
;
                break;
            case 5:
                $theme = "theme";
                $bootstrap = "bootstrap";
                $MDB = "MDB";
                $cont = $this->collection($app);
                $c = "active";
                $footer=VueFactory::footer(false,$theme,$app);
                $js=<<<END
                <script type='text/javascript' src='theme/js/supp.js'></script>
END;
                break;
            case 6:
                $theme = "theme";
                $bootstrap = "bootstrap";
                $MDB = "MDB";
                $cont = $this->collectionHeros($app);
                $c = "active";
                $footer=VueFactory::footer(false,$theme,$app);
                $js=<<<END
                <script type='text/javascript' src='theme/js/add.js'></script>
END;
                break;
            case 7:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->collectionHeroD($app);
                $c = "active";
                $footer=VueFactory::footer(false,$theme,$app);
                $js=<<<END
                <script type='text/javascript' src='../theme/js/add.js'></script>
END;
                break;
            case 8:
                $theme = "theme";
                $bootstrap = "bootstrap";
                $MDB = "MDB";
                $cont = $this->collectionSerie($app);
                $footer=VueFactory::footer(false,$theme,$app);
                $c = "active";
                $js=<<<END
END;
                break;
            case 9:
                $theme = "theme";
                $bootstrap = "bootstrap";
                $MDB = "MDB";
                $cont = $this->Envie($app);
                $a = "active";
                $footer=VueFactory::footer(false,$theme,$app);
                $js=<<<END
                <script type='text/javascript' src='theme/js/Envie.js'></script>
END;
                break;
            case 10:
                $theme = "../../theme";
                $bootstrap = "../../bootstrap";
                $MDB = "../../MDB";
                $cont = $this->AddByIdInfo($app);
                $footer=VueFactory::footer(false,$theme,$app);
                $a = "active";
                break;
            case 11:
                $theme = "../../theme";
                $bootstrap = "../../bootstrap";
                $MDB = "../../MDB";
                $cont = $this->AddByIdInfoError($app);
                $footer=VueFactory::footer(false,$theme,$app);
                $a = "active";
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
                <li class="nav-item nav-barre">
                    <p class="nav-link" style="color: white;margin: 0;">|</p>
                </li>
                <li class="nav-item $h">
                    <a class="nav-link" href="$urlH">Héros</a>
                </li>
                <li class="nav-item nav-barre ">
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
                <li class="nav-item nav-barre">
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
     $footer

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

    public function accueil($app){
        $user=$this->content["user"];
        $urlAddById = $app->urlFor("addFastById");
        $urldeco = $app->urlFor("deconnexion");
        $pseudo=$user->pseudo;
        $nbc=$this->content["nblivre"];
        $date=$this->content["date"];
        $book="";
        $lastAjout=$this->content["lastAjout"];
        $nbSerieTerm=$this->content["nbSerieTerm"];
        $nbSerieNonTerm=$this->content["nbSerieNonTerm"];
        $manquant=$this->content["manquant"];
        $depense=$this->content["depense"];
        $difference=$this->content["difference"];
        $depenseCetteA=$this->content["depenseCetteA"];
        $envie=$this->content["envie"];
        $coutEnv=$envie->sum("prix");
        $nbEnv=$envie->count();
        if(sizeof($this->content["lastAjout"])==0){
            $book=<<<END
                 <div class="col-12" style="text-align: center">vous n'avez pas encore de comics dans votre bedetheque. </div>
END;
        }

        $book=VueFactory::listComics($lastAjout,"",$app);

        $admin="";
        if($_SESSION["profile"]["role_id"]==2){
            $url=$app->urlFor('adminHome');
            $admin=<<<END
            <a href="$url" class="col-12" >
                <button id="admin" type="button"  class="col-12 btn-admin btn  btn-default btn-lg waves-effect waves-light">ADMIN</button>
            </a>           
END;
        }

        return <<<END
    <div class="marginTBB container">
          <main role="main" class="inner cover">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
					    <fieldset class="fieldset1">
					        <legend style="width: auto">User</legend>
                            <h4>$pseudo</h4>
                            <p>Vous avez $nbc comics dans votre bdtecheque.</p>
                            <strong style="float: right">Inscrit depuis $date</strong>
                        </fieldset>
                        <fieldset class="fieldset2">
					        <legend style="width: auto">Ajout Rapide</legend>
                            <h5>Ajouter rapidement grace à l'ISBN ou l'EAN.</h5>
                            <form class=" col-12" style="margin: 0;padding: 0" onsubmit="return Form.module.search.start()"  action="$urlAddById" method="post">
                                <input id="isbn" class="  col-12" type="text" name="ISBNEAN" placeholder="Search" aria-label="Search">
                            </form>
                        </fieldset>
                    </div>
                    <div class="col-lg-6">
					    <canvas id="lineChart"></canvas>
					    <p style="text-align: center">Récap de vos achat des derniers mois</p>
                    </div>
                    <div class="col-12 AcButton row" style="margin-top: 2%;padding-right: 0%">
                        <div class="col-6" style="padding-right: 5px">
                            <button id="ModCompte" type="button" class="col-12 btn btn-default btn-lg waves-effect waves-light">Modifier mon compte</button>
                        </div>
                        <a href="$urldeco" class="col-6" style="padding-left: 5px">
                            <button href="$urldeco" id="deco" type="button"  class="col-12 btn btn-default btn-lg waves-effect waves-light">Déconnexion</button>
                        </a>                        
                        $admin
                    </div>
                </div>
                <div class=" col-12" style="padding-right: 0;">
                    <div class="row catalogue " style="padding: 0">
                        <h1 class="sectionTitle">Vos derniers ajouts</h1>
                        <span class=" container sectionWatchers"><i class="fas fa-plus" style="display:none;"></i><i class="fas fa-minus" style=""></i></span> 
                        <section class=" col-12 row">
                            $book
                        </section>
                    </div>
                </div>
                <div class="row col-12">
                    <h1 class="sectionTitle">Vos Statistiques</h1>
                    <span class=" container sectionWatchers"><i class="fas fa-plus" style="display:none;"></i><i class="fas fa-minus" style=""></i></span> 
                    <div class="row col-12" style="padding-right: 0;">
                        <div class="col-6 chart">
                            <canvas id="polarChart"></canvas>
                            <p style="text-align: center">Vos heros selon leur univers</p>
                        </div>
                         <div class="col-6 chart">
                            <canvas id="pieChart"></canvas>
                            <p style="text-align: center">Vos cinq heros préféré</p>
                        </div>
                        <div class="col-4 chart">
                            <canvas id="pieChart2"></canvas>
                            <p style="text-align: center">votre co</p>
                        </div>
                        <div class="col-8 chart">
                            <canvas id="barChart"></canvas>
                            <p style="text-align: center">votre co</p>
                        </div>
                         <div class="col-6 chart" style="padding: 0%;border-right: solid 1px">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">Argent</th>
                                    <th scope="col">statistique</th>
                                </tr>
                            </thead>
                            <tbody ">
                                <tr>
                                    <th scope="row">Argent depensé</th>
                                    <td>$depense €</td>
                                </tr>
                                <tr>
                                    <th scope="row" title="L'argent manquant pour completer vos serie en cours.">Argent manquant</th>
                                    <td>$manquant €</td>
                                </tr>
                                <tr>
                                    <th scope="row" title="Différence entre les prix d'achat et celui des produits par défaut.">diffèrence </th>
                                    <td>$difference €</td>
                                </tr>
                                <tr>
                                    <th scope="row" title="l'argent depensé en moyenne pour l'achat de vos comics cette année">argent dépensé en moyenne par mois</th>
                                    <td>$depenseCetteA €</td>
                                </tr>
                                <tr>
                                    <th scope="row" title="l'argent nécessaire pour acheter les comics dans la rubrique 'Vos Envie'">Argent pour vos Envies</th>
                                    <td>$coutEnv €</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                         <div class="col-6 chart" style="padding: 0%;border-left: solid 1px">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">statistique</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">nb serie terminé</th>
                                    <td>$nbSerieTerm</td>
                                </tr>
                                <tr>
                                    <th scope="row">nb serie non terminé</th>
                                    <td>$nbSerieNonTerm</td>
                                </tr>
                                <tr>
                                    <th scope="row">nb serie de vos envie</th>
                                    <td>$nbEnv</td>
                                </tr>
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
			</div>
          </main>
        </div>
        <div id="MyModal" class="modal">
            <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="text-align: left">Modifier Vos Informations :</h2>
                        <button id="closeInvitModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  row" style=" margin: 3% ;max-height: 1000px;overflow-y : auto;">
                        <div class="col-5" style="text-align: left; padding: 3%">
                            <div id="messagediv">
                                <p id="message"></p>
                            </div>
                            <h6>Pseudo</h6>
                            <input id="pseudo" type="text"  class="col-lg-12" style="color: black" value="$user->pseudo">
                            <h6>email</h6>
                            <input id="email" type="email" class="col-lg-12" style="color: black" value="$user->mail">
                        </div>
                        <div class="col-2">
                            <img src="theme/ressources/barre.png">
                        </div>
                        <div class="  col-5 AcButton" style=" padding: 3%">
                            <button id="update" class=" col-lg-12 btn btn-default btn-lg waves-effect waves-light">Modifier mes infos</button>
                            <p></p>
                            <button class="col-lg-12 btn btn-default btn-lg waves-effect waves-light">modifier mon mot de passe</button>
                        </div>  
                    </div>
                 <div class="modal-footer">
                </div>
            </div>          
        </div>
END;
;
    }

    function heros($app){
        $cont="";
        $app = \Slim\Slim::getInstance();

        $cont=VueFactory::listeHeros($this->content['listHeros'],"",'HeroDetail',$app);
        $i=1;
        $page="";
        while($i<=$this->content['page']) {
            $urlp = $app->urlFor('Heros', ["nbP" => $i]);
            if ($i == $this->content['current']) {
                $page .= <<<END
                        <li>
                        <li><a href="#" class="is-active">$i</a></li>
    </li>
END;
            } else {
                $page .= <<<END
                <li>
                    <a href="$urlp" title="page $i">$i</a>
                </li>

END;
            }

            $i++;
        }
        $old="";

        if($this->content['current']>1) {
            $urlfirst= $app->urlFor('Heros', ["nbP" =>1]);
            $urlP= $app->urlFor('Heros', ["nbP" => $this->content['current'] - 1]);
            $old = <<<END
                <li><a href="$urlP" class="prev fa fa-arrow-left" title="previous page"> </a></li>
END;
        }
        $next="";
        if($this->content['current']<(int)$this->content['page']) {
            $urllast = $app->urlFor('Heros', ["nbP" => (int)$this->content['page']]);
            $urlN= $app->urlFor('Heros', ["nbP" => $this->content['current'] + 1]);
            $next = <<<END
               <li><a href="$urlN" class="next fa fa-arrow-right" title="next page"> </a></li>
END;
        }

        return $cont=<<<END
        <div class="marginTBB container">
          <main role="main" class="inner cover" style="padding: 0">
            <div class="row">
               <h1 class="sectionTitle">Héros ou vilain</h1>
               <span class=" container sectionWatchers"></span> 
            </div>
			<div class="row rowHeroCatalogue">
				$cont
            </div>
            <header class="shine paginationShine" ></header>
            <div class="col-12" style="text-align: center">
                <div class="pagination p1">
                    <ul>
                        $old
                        $page
                        $next
                    </ul>
                </div>
            </div>
          </main>
        </div>
END;

    }

    function heroD($app){

        $book="";
        $bs=$this->content["books"];
        if(sizeof($this->content["books"])==0){
            $book=<<<END
                 <div class="col-12" style="text-align: center">Cette heros ne dispose de comics. </div>
END;
        }
        $book=VueFactory::listComics($bs,"../",$app);

        $Serie="";
        $Se=$this->content["serie"];
        if(sizeof($Se)==0){
            $Serie=<<<END
                <div class="col-12" style="text-align: center">Cette heros ne dispose de serie actuellement. </div>
END;
        }
        $Serie=VueFactory::listeSerie($Se,$app);


        $alli="";
        $als=$this->content["allie"];
        foreach($als as $a){
            $alli.=<<<END
                <p> - $a->nom</p>
END;
        }
        $enem="";
        $ens=$this->content["enemi"];
        foreach($ens as $e){
            $enem.=<<<END
                <p> - $e->nom</p>
END;
        }
        $equipe="";
        $eq=$this->content["equipe"];
        foreach($eq as $e){
            $equipe.=<<<END
                <p> - $e->nom</p>
END;
        }
        $h=$this->content["heros"];
        return $cont=<<<END
        <div class="marginTBB container" style="min-height: 0;margin-bottom: 0%">
            <main role="main" class="inner cover HeroInfoGeneral" style="padding: 0">
                    <div class="row">
                        <h1 class="sectionTitle">$h->nom</h1>
                        <span class=" container sectionWatchers"></span> 
                    </div>
                    
                    <div class="col-12" style="margin-right: -15px;margin-left: -15px;margin-bottom: 2%"> 
                        <div class="row">
                            <img class=" HeroDImage col" src="../theme/ressources/heros/$h->img" style="padding: 0;height: 300px">
                            <div class="HeroDDesc col" style="padding-top: 7%">
                                $h->desc
                            </div>
                        </div>
                    </div>
            </main>
        </div>
        <div class="" style="background-color:#740f00 ;width: 100% ; color :white;margin-top: 0%">
            <main role="main" class="marginTBB marginTBBhero container inner cover" style="padding: 0 ;margin-top:0%;margin-bottom: 0%">
                    <div class="col-12" style="">
                    <div class="row HeroInfo">
                        <div class="col infoBase">
                            <div><strong>NOM :</strong> $h->nom</div>
                            <div class="overflowSurnom"><strong>SURNOM : </strong></div>
                            <div class="overflowpower" title="$h->pouvoir"><strong>POUVOIR : </strong> $h->pouvoir </div>
                            <div><strong>UNIVERS : </strong>$h->Univers </div>
                        </div>
                        <div class="col-3 module line-clamp infoEquipe">
                            <div><strong>Equipe :</strong></div>
                            $equipe
                        </div>
                        <div class="col infoHeros">
                            <div class="row">
                                <div class="col-6 module line-clamp">
                                    <div><strong>Allié :</strong></div>
                                    $alli
                                </div>
                                <div class="col-6 module line-clamp">
                                    <div><strong>Enemi :</strong></div>
                                    $enem
                                </div>
                            </div>
                        </div> 
                        <div class="col infoLogo">
                            <div>
                                <strong>Logo :</strong>
                                <img class="col-12" src="../theme/ressources/logo/$h->Logo" style="padding: 4% 0% 0% 0%;height: 150px">
                            </div>
                        </div>
                    </div>
                        <hr class="shine" style="border-top: 1px solid #740f00; ">
                    </div>
                    <div class="row col-12 HeroInfoLivre" style=" padding :0;margin-right: -15px;margin-left: -15px;"> 
                        <div class=" col-12" style="padding-right: 0;">
                            <div class="row catalogue " style="padding: 0">
                                <h1 class="sectionTitleH">Ajout récent</h1>
                                <span class=" container sectionWatchersH"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span> 
                                <section class=" col-12 row" style="padding-bottom: 25px">
                                    $book
                                </section>
                            </div>
                        </div>
                        <div class=" col-12" style="padding-right: 0;">
                            <div class="row catalogue " style="padding: 0">
                                <h1 class="sectionTitleH">Ses séries</h1>
                                <span class=" container sectionWatchersH"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span> 
                                <section class=" col-12 row" style="padding-bottom: 25px">
                                    $Serie
                                </section>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
END;

    }

    function serieD($app){
        $s=$this->content["serie"];
        $cont="";
        $h=$this->content["heros"];
        $lc=$this->content["listeComics"];
        $s=$this->content["serie"];
        $manquant=$this->content["manquant"];
        $depense=$this->content["depense"];
        $prixParDefaut=$this->content["prixParDefaut"];
        $nbSortie=$this->content["nbSortie"];
        $prixParAns=$this->content["prixParAns"];
        $cont=VueFactory::listComicsSerie($lc,"../",$app);
        return $html=<<<END
        <div class="marginTBB container serie">
            <main role="main" class="inner cover" style="padding: 0">
                    <div class="row">
                        <h1 class="sectionTitle">$s->nom</h1>
                        <span class=" container sectionWatchers"></span>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-6 livreOrderBy">
                                <i id="card" class=" active fas fa-2x fa-th"></i>
                                <i id="list" class="fas fa-2x fa-th-list"></i>
                            </div>
                            <div class="col-6 livreOrderByuser">
                                <p style="float: right"> <strong id="alb" class="active">Album dans votre collection</strong> <strong style="color:#740f00 ">|</strong><strong id="albM" class=""> Album manquant </strong></p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class=" catalogue">
                                <div class="col-12 row">
                                    $cont
                                    <div class="col-12 row" style="text-align: center;display: none;padding-top: 2%" id="button">
                                        <button id="modif" type="button" style="width: 32%;margin-right: 1%" class=" btn btn-default btn-lg waves-effect waves-light">supprimer</button>
                                        <button id="modif" type="button" style="width: 32%;margin-right: 1%" class=" btn btn-default btn-lg waves-effect waves-light">ajouter</button>
                                        <button id="modif" type="button" style="width: 32%;margin-right: 1%" class=" btn btn-default btn-lg waves-effect waves-light">ajouter au envie</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                    <h1 class="sectionTitle">Vos Statistiques</h1>
                    <span class=" container sectionWatchers"><i class="fas fa-plus" style="display:none;"></i><i class="fas fa-minus" style=""></i></span> 
                    <div class="row col-12" style="padding-right: 0;">
                        <div class="col-8" style="padding: 0%;border-right: solid 1px">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">statistique</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Argent depensé</th>
                                        <td> $depense €</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Argent manquant</th>
                                        <td>$manquant €</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" title="différence entre les prix d'achat et celui des produits par défaut ">diffèrence </th>
                                        <td>$prixParDefaut €</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" title="nb de sortie par ans environ">nb de sortie par ans</th>
                                        <td> $nbSortie </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">argent dépensé en moyenne par ans</th>
                                        <td> $prixParAns €</td>
                                    </tr>
                                </tbody>
                             </table>
                        </div>
                        <div class="col-4">
                            <canvas id="pieChart2"></canvas>
                            <p style="text-align: center">votre co</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
END;

    }

    function livreD($app){
        $books=$this->content["livre"];
        $heros=$this->content["heros"];

        $urladd2col = $app->urlFor('addFastCollection', ["ISBN" => $books->ISBN]);
        $urlsupp2col = $app->urlFor('suppFastCollection', ["ISBN" => $books->ISBN]);
        $urladd2Env = $app->urlFor('addFastEnvie', ["ISBN" => $books->ISBN]);
        $urlsupp2Env = $app->urlFor('suppFastEnvie', ["ISBN" => $books->ISBN]);
        $lienheros="";
        foreach ($heros as $h){
            $urlHeroD = $app->urlFor("HeroDetail", ["id" => $h->id]);
            $lienheros.=<<<END
            <a href="$urlHeroD" style="color: #740f00 ">$h->nom</a>
END;
        }
        $serie=$this->content["serie"];
        $nomSerie=" inconu";
        if($serie!=null){
            $urlSerieD=$app->urlFor("SerieDetail", ["id" => $serie->id]);
            $nomSerie="<a href='$urlSerieD'>$serie->nom</a>";
        }

        $env="";
        if (!$books->isEnvie()) {
            $env .= "<btn id=\"popAEnv\" type=\"button\" class=\"col-lg-12 btn btn-default btn-lg waves-effect waves-light\">ajouter à votre liste d'envie</btn>";
        }else{
            $env .= "<btn id=\"popSEnv\" type=\"button\" class=\"col-lg-12 btn btn-default btn-lg waves-effect waves-light\">supprimer de votre liste d'envie</btn>";
        }
        $add="";
        if (!$books->isPossede()) {
            $add .= "<btn id='popAdd' type='button'  style=\"margin-top: 2%\" class=\"col-lg-12 btn btn-default btn-lg waves-effect waves-light\">ajouter à la bedetheque</btn>";
        }else {
            $env = "";
            $prix=$this->content["prix"];
            $add .=<<<END
            <span>acheté pour <input style="color: black" type="number" value="$prix">€</span> 
            <btn id="popSupp" type="button"  style="margin-top: 2%" class="col-lg-12 btn btn-default btn-lg waves-effect waves-light">supprimer de la bedetheque</btn>
            
END;
        }
        $rating=VueFactory::ratingDetail($books->ISBN);
        $commentaireDetail=VueFactory::commentaireDetail($this->content["commentaire"]);

        return $html=<<<END

        <div class="infopopup">
        </div>
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                        <span class=" container" style=" width:100% ;height: 0;position:absolute;z-index:-1;border-bottom: 2px solid #740f00;float: left;"></span>
                    
                    <img class="col-lg-3" style="background-color: white" src="../theme/ressources/livre/$books->img">
                    <div class="col-9" style="padding: 0;padding-top: 3%">
                     
                        <div class="row col-lg-12" style="padding: 0">
                        <div class="col-5">
                            <h4 style="margin-bottom: 4%">$books->titre</h4>
                            <h5>ISBN :<strong id="ISBN">$books->ISBN</strong></h5>
                            <h5>EAN  :$books->EAN</h5>
                            <h5>prix : <strong id="prixDef">$books->prix</strong> €</h5>
                            <div class="line-clamp">Hero : $lienheros</div>
                        </div>
                        <div class="col-7" style="text-align: right;padding: 0" >
                            <h4 style="color: #740f00 ">paru le $books->date chez $books->Editeur</h4>
                            <h5>serie : $nomSerie</h5>
                            $rating
                            <h5 style="color: #740f00 "><i class="fab fa-2x fa-amazon"></i></h5>
                            <div class="col-12 AcButton" style="margin-top: 2% ;padding: 0">
                                $env
                                $add
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="" style="background-image: url('../theme/ressources/com-wall.jpg');background-position:right top;width: 100% ;margin-top: -15%">
            <main role="main" class="marginTBB marginTBBhero container inner cover" style="padding: 0 ;margin-top:0%;margin-bottom: 0%;">
            <div class="row">
                <h1 class="">Commentaire :</h1>
                <span class=" container sectionWatchers" style="height: 50px;"></span>
            </div>
            <div>
                $commentaireDetail
                <div class="col-12 row">
                    <textarea id="usermsg" class="col-12" id="com" name="com" rows="3" style="border: solid 5px #666" >
                    It was a dark and stormy night...
                    </textarea>
                    <button id="submitmsg" type="button" style="width: 100%;margin-top:1%;color:white" class="col-5 offset-7 btn-admin btn  btn-default btn-lg waves-effect waves-light">Ajouter votre commentaire</button>
              </div>
            </div>
            </main>
        </div>
        <div id="myModal">
            
        </div>
END;
    }

    function collection($app){

        $com=VueFactory::listComics($this->content,"",$app);

        return $html=<<<END
                <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Tous vos comics</h1>
                    <span class=" container sectionWatchers"></span> 
                </div>
                <div class=" catalogue"> 
                   <div class="col-12 row">
                   $com
                   </div>
                </div>
            </main>
        </div>
END;

    }

    function collectionHeros($app){
        $cont="";
        foreach ($this->content as $h){
            $url = $app->urlFor('CollectionHeroD', ["id" => $h["id"]]);
            $img=$h["img"];
            $nom=$h["nom"];
            $cont .= <<<END
            <!-- Card -->
            <div class=" col-2 card-cascade heroCatalogue" style="">
                <a href="$url" >
                <div class="hero">
                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient" style="padding: 0">
                        <img class="col-lg-12 heroImg" src="theme/ressources/heros/$img">
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">
                    <!-- Text -->
                        <div class="card-text">
                            $nom
                        </div>
                        <hr class="shine heroShine" >
                    </div>
                </div>
                </a>
            </div>
END;
        }
        return $html=<<<END
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Tous vos Héros</h1>
                    <span class=" container sectionWatchers"></span> 
                </div>
                <div class=" row rowHeroCatalogue ">    
                   $cont
                </div>
            </main>
        </div>
END;

    }

    function collectionHeroD($app){

        $book=VueFactory::listComics($this->content["books"],"../",$app);


        $serie=VueFactory::listeSerie($this->content["serie"],$app);

        $alli="";
        $als=$this->content["allie"];
        foreach($als as $a){
            $alli.=<<<END
                <p> - $a->nom</p>
END;
        }
        $enem="";
        $ens=$this->content["enemi"];
        foreach($ens as $e){
            $enem.=<<<END
                <p > - $e->nom</p>
END;
        }
        $equipe="";
        $eq=$this->content["equipe"];
        foreach($eq as $e){
            $equipe.=<<<END
                <p> - $e->nom</p>
END;
        }
        $h=$this->content["heros"];
        return $cont=<<<END
         <div class="marginTBB container" style="min-height: 0;margin-bottom: 0%">
            <main role="main" class="inner cover" style="padding: 0">
                    <div class="row">
                        <h1 class="sectionTitle">$h->nom</h1>
                        <span class=" container sectionWatchers"></span> 
                    </div>
                    
                    <div class="col-12" style="margin-right: -15px;margin-left: -15px;margin-bottom: 2%"> 
                        <div class="row">
                            <img class=" HeroDImage col" src="../theme/ressources/heros/$h->img" style="padding: 0;height: 300px">
                            <div class="HeroDDesc col" style="padding-top: 7%">
                                $h->desc
                            </div>
                        </div>
                    </div>
            </main>
        </div>
        <div class="" style="background-color:#740f00 ;width: 100% ; color :white;margin-top: 0%">
            <main role="main" class="marginTBB container inner cover" style="padding: 0 ;margin-top:0%;margin-bottom: 0%">
                    <div class="col-12" style="">
                    <div class="row HeroInfo">
                        <div class="col infoBase">
                            <div><strong>NOM :</strong> $h->nom</div>
                            <div class="overflowSurnom"><strong>SURNOM : </strong></div>
                            <div class="overflowpower" title="$h->pouvoir"><strong>POUVOIR : </strong> $h->pouvoir </div>
                            <div><strong>UNIVERS : </strong>$h->Univers </div>
                        </div>
                        <div class="col-3 module line-clamp infoEquipe">
                            <div><strong>Equipe :</strong></div>
                            $equipe
                        </div>
                        <div class="col infoHeros">
                            <div class="row">
                                <div class="col-6 module line-clamp">
                                    <div><strong>Allié :</strong></div>
                                    $alli
                                </div>
                                <div class="col-6 module line-clamp">
                                    <div><strong>Enemi :</strong></div>
                                    $enem
                                </div>
                            </div>
                        </div> 
                        <div class="col infoLogo">
                            <div>
                                <strong>Logo :</strong>
                                <img class="col-12" src="../theme/ressources/logo/$h->Logo" style="padding: 4% 0% 0% 0%;height: 150px">
                            </div>
                        </div>
                    </div>
                        <hr class="shine" style="border-top: 1px solid #740f00; ">
                    </div>
                    <div class="row col-12" style=" padding :0;margin-right: -15px;margin-left: -15px;"> 
                        <div class=" col-12" style="padding-right: 0;">
                            <div class="row catalogue " style="padding: 0">
                                <h1 class="sectionTitleH">Album ajouté récemment</h1>
                                <span class=" container sectionWatchersH"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span> 
                                <section class=" col-12 row" style="padding-bottom: 25px">
                                    $book
                                </section>
                            </div>
                        </div>
                        <div class=" col-12" style="padding-right: 0;">
                            <div class="row catalogue " style="padding: 0">
                                <h1 class="sectionTitleH">Ses séries</h1>
                                <span class=" container sectionWatchersH"><i class="fas fa-plus   " style="display:none;"></i><i class="fas fa-minus" style=""></i></span> 
                                <section class=" col-12 row" style="padding-bottom: 25px">
                                    $serie
                                </section>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
END;

    }

    function collectionSerie($app){
        $cont="";

        foreach ($this->content as $s){

            $url = $app->urlFor('SerieDetail', ["id" => $s->serie]);
            $complet="serieNONComplete";
            if($s->numberComics==$s->nblivre){
                $complet="serieComplete";
            }
            $cont .= <<<END
            <div class=" serie card  col-lg-12" style="padding: 0">
                <a href="$url">
                <h5 class=" row col-12" style="margin: 1% 0%;color: black"><div class="overflow-ellipsis">$s->nom</div><strong class="$complet" style="width: 20%;text-align: right">$s->numberComics/$s->nblivre</strong></h5>
                </a>
            </div>
END;
        }
        return $html=<<<END
        
        
        <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Toutes vos séries</h1>
                    <span class=" container sectionWatchers"></span> 
                </div>
                <div class=" row">    
                   $cont
                </div>
            </main>
        </div>
END;

    }


    function Envie($app){
        $com=VueFactory::listEnv($this->content,"",$app);

        return $html=<<<END
                <div class="marginTBB container">
            <main role="main" class="inner cover" style="padding: 0">
                <div class="row">
                    <h1 class="sectionTitle">Votre liste d'envie</h1>
                    <span class=" container sectionWatchers"></span> 
                </div>
                <div class=" catalogue"> 
                   <div class="col-12 row">
                   $com
                   </div>
                </div>
            </main>
        </div>
END;

    }

    function AddByIdInfo($app){
        $l=$this->content;
        $urlA = $app->urlFor("accueil");
        $url=$app->urlFor('livreDetail', ["ISBN" => $l->ISBN]);
        $img="../../theme/ressources/livre/$l->img";
        return $html=<<<END
        <div class="marginTBB container">
          <main role="main" class="inner cover" style="padding: 0">
            <div class="row">
                <div class="row col-12 list-containerSearch">
                    <div class="col-lg-1 checkbox" style="text-align: center;padding-top: 40px"><input type="checkbox" id="scales" ></div>
                    <div class="col-lg-1 list-img" style="background: url($img) center no-repeat;background-size: 100% 100%;" ISBN="$l->ISBN" ></div>
                    <div class=" col-10 row listInfo">
                        <div class="col-10">
                            <h3><a href="$url">titre :$l->titre</a></h3>
                            <h5>4/5 sur 10 votes</h5>
                        </div>
                    </div>
                </div>
                <a href="$urlA"class="col-lg-12 ">
                    <button id="admin" type="button" style="width: 100%;margin-top:1%" class="col-6 offset-3 btn-admin btn  btn-default btn-lg waves-effect waves-light">Accueil</button>
                </a>  
            </div>
          </main>
        </div>
END;

    }

    function AddByIdInfoError($app){
        $urlA = $app->urlFor("accueil");
        return $html=<<<END
        <div class="marginTBB container">
          <main role="main" class="inner cover" style="padding: 0">
            <div class="row">
                <div class="col-lg-12">
                    <h1>NOT FOUND $this->content</h1>
                    <a href="$urlA">
                        <button id="admin" type="button" style="width: 100%;margin-top:1%" class="col-6 offset-3 btn-admin btn  btn-default btn-lg waves-effect waves-light">Accueil</button>
                    </a>  
                </div>
            </div>
          </main>
        </div>
END;

    }


    function getmounth($_mountnmbr)
    {
        switch ($_mountnmbr) {
            case '1':
                return 'Janvier';
                break;
            case '2':
                return 'Février';
                break;
            case '3':
                return 'Mars';
                break;
            case '4':
                return 'Avril';
                break;
            case '5':
                return 'Mai';
                break;
            case '6':
                return 'Juin';
                break;
            case '7':
                return 'Juillet';
                break;
            case '8':
                return 'Août';
                break;
            case '9':
                return 'Septembre';
                break;
            case '10':
                return 'Octobre';
                break;
            case '11':
                return 'Novembre';
                break;
            case '12':
                return 'Décembre';
                break;
        }
    }

}