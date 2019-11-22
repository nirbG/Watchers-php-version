<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08/11/2017
 * Time: 19:56
 */

namespace watchers\vues;

class VueAccueil {

    private $content;

    function __construct($req = null) {
        $this->content = $req;
    }

    public function render($id) {
        $app = \Slim\Slim::getInstance();
        //initialisation des routes
        switch ($id) {
            case 0:
                $cont = $this->accueil($app);
                break;
            case 1:
                $cont=$this->compte($app);
        }
        $w = $this->content;
        $wallp=$w->img;
        // responsive back move top lef or top right
        $style = <<<END
            style="
            background: url('theme/ressources/accueil/$wallp') no-repeat center center fixed ;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
           "

END;

        $html = <<<END
<!DOCTYPE html>
<html lang="fr" $style >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="theme/ressources/logoOnglet.png">

    <title>Watchers</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="bootstrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="bootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Custom styles for this template -->
    <!--link href="bootstrap/css/main.css" rel="stylesheet"-->
    <link href="theme/css/main.css" rel="stylesheet">
  </head>
  <body   style="color: $w->colorText;">
    
    $cont
    <style type="text/css">
    
#Watcher a{
    color: $w->colorText;
        text-shadow: 1px 1px $w->colorShadow , 2px 2px $w->colorShadow , 3px 3px $w->colorShadow;
}
#Watcher a:hover {
    text-shadow: 1px 1px $w->colorShadow , 2px 2px $w->colorShadow , 3px 3px $w->colorShadow , 4px 4px $w->colorShadow , 5px 5px $w->colorShadow , 6px 6px $w->colorShadow;
}
#co{
    color:$w->colorText;
    background-color:transparent;
    border: .05rem solid $w->colorText;
    /*text-shadow: 1px 1px  $w->colorShadow,2px 2px  $w->colorShadow, 3px 3px   $w->colorShadow; */
    box-shadow: 1px 1px  $w->colorShadow,2px 2px  $w->colorShadow, 3px 3px   $w->colorShadow;
}
#co:hover {
     box-shadow: 1px 1px $w->colorShadow, 2px 2px $w->colorShadow, 3px 3px $w->colorShadow, 4px 4px $w->colorShadow, 5px 5px $w->colorShadow, 6px 6px $w->colorShadow;
}

</style>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--script src="bootstrap/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <!--<script src="theme/Js/accueilcarrousel.js"></script>-->
    <script src="theme/js/modal.js"></script>
    <script type='text/javascript' src='MDB/js/mdb.min.js'></script> 
  </body>
  
</html>

END;
        return $html;
    }

    public function accueil($app) {
        $url  = $app->urlFor('formCo', ["erreur" => 'input']);
        $urlA = '';
        $w = $this->content;
        $fondT="";
        if($w->fond==1) {
            $fondT = " <div class='ombreAc'></div>";
        }
        $html = <<<END

    
    <div class="site-wrapper" style="">
        

      <div class="site-wrapper-inner">

        <div class="cover-container">

         $fondT
          <header class="masthead clearfix">
            <div class="inner">
              <h3 style="float: left" class="masthead-brand" id="Watcher"><a href="$urlA"><img class="logo" style="float: left;padding-top: 1%" class="col-8" src="theme/ressources/logo.png" ></a></h3>
              <nav class="nav nav-co nav-masthead">
                <a href="$url" id="co" class="btn  btn-secondary" style="margin: 0">Connexion</a>
              </nav>
            </div>
          </header>
          <main role="main" class="inner cover">
            <h1 class="cover-heading">Bienvenue.</h1>
            <p class="lead">Dans cette bibliothèque en ligne spécialisée dans les comics. Découvrez et partagez autour de votre passion pour les comics, enrichissez la base de données et gérez votre collection gratuitement avec la bliotheque des Watchers.</p>
            <p class="lead">
              <a id="savoirplus" class="btn btn-lg btn-secondary" style=" color:$w->colorText;background-color:$w->colorBouton;border: .05rem solid $w->colorText;">En savoir plus</a>
            </p>
          </main>
          <footer class="mastfoot">
            <div class="inner">
              <p>Projet personnel.</p>
            </div>
          </footer>
          
        </div>

      </div>
       <div id="myModal" class="modal">
        <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2 style="text-align: left">En savoir plus :</h2>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body" style="max-height: 500px;overflow-y : scroll;">
                    <header class="page-header">
                        <h1>A faire</h1>
                    </header>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
END;
        return $html;
    }

    public function compte($app) {

    }
}