<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/08/2018
 * Time: 23:24
 */

namespace watchers\vues;


class VueCompte
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
        //initialisation des routes
        switch ($id) {
            case 0:
                $cont = $this->formCo($app);
                $js = "<script type='text/javascript' src='theme/js/form.js'></script>";
                break;
            case 1:
                $cont = $this->formInsc($app);
                $js = "<script type='text/javascript' src='theme/js/formInsc.js'></script>";
                break;
            case 2:
                $cont = $this->PasswordForgotBeforeEmail($app);
                $js = "<script type='text/javascript' src='theme/js/formInsc.js'></script>";
                break;
            case 3:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->PasswordForgotAfterEmail($app);
                $js = "<script type='text/javascript' src='../theme/js/formUpdatepassword2.js'></script>";
                break;
            case 4:
                $theme = "../theme";
                $bootstrap = "../bootstrap";
                $MDB = "../MDB";
                $cont = $this->formInsc($app);
                $js = "<script type='text/javascript' src='theme/js/formInsc.js'></script>";
                break;
        }
        $style = <<<END
            style="
            background: url('$theme/ressources/baroom-comic-book--wallpaper.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;"
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
    <link rel="icon" href="$theme/ressources/logoOnglet.png">

    <title>Watchers</title>

    <!-- Bootstrap core CSS -->
    <link href="$bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="$bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="bootstrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="$bootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="$bootstrap/css/main.css" rel="stylesheet">
    <link href="$theme/css/all.css" rel="stylesheet">
    <link href="$theme/css/main.css" rel="stylesheet">
  </head>
  <body   style="color: #fff;">
    $cont
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="$bootstrap/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--script src="bootstrap/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="$bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    $js
        <style type="text/css">
    
#Watcher a{
    color: #fff;
        text-shadow: 1px 1px #000 , 2px 2px #000 , 3px 3px #000;
}
#Watcher a:hover {
    text-shadow: 1px 1px #000 , 2px 2px #000 , 3px 3px #000 , 4px 4px #000 , 5px 5px #000 , 6px 6px #000;
}
</style>
  </body>
</html>

END;
                return $html;
        }

    public function formCo($app) {
        $co = $app->urlFor('connexion');
        $urlA = $app->urlFor('accueil');
        $insc = $app->urlFor('formInsc', ["erreur" => 'input']);
        $pssw = $app->urlFor('passwForgot', ["erreur" => 'input']);
        $warnning = "";
        if($this->content!=null) {
            $warnigMess = $this->content;
            if ($warnigMess != "") {
                $warnning = <<<END
                    <div id="erreurForm" class="margin-both-lg-2 col-lg-8 alert alert-danger alert-dismissable ">
                        <i class="ninety-four fas fa-exclamation-triangle"></i>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        $warnigMess
                    </div>
END;
            }
        }

        $html = <<<END

    <div class="site-wrapper ">

      <div class="site-wrapper-inner">

        <div class="cover-container">
          <div class="ombreCo"></div>
          <header class="masthead clearfix">
            <div class="inner">
               <h3 style="float: left" class="masthead-brand" ><a href="$urlA"><img style="float: left;padding-top: 1%" class="col-8" src="theme/ressources/logo.png" ></a></h3>
            </div>
          </header>

          <main id="FormCo" role="main" class="inner cover">
            <form onsubmit="return Form.module.submit.start()"  action="$co" method="post">
                <div class="row form-group">
                    <h1 class="col-lg-12 cover-heading formTitle ">Se Connecter</h1>
                    $warnning
                </div>
                <div class="row">
                    <h3 class="margin-both-lg-2 col-lg-8">Email</h3>
                    <div class="col-lg-8 margin-both-lg-2">
                         <input id="email" class="col-lg-12" type="email" name="email" value="">
                        <span class="help-block">Veuillez saisir un email.</span>
                    </div>
                    <h3 class="margin-both-lg-2 col-lg-8">Mot de passe</h3>
                    <div class="col-lg-8 margin-both-lg-2">
                        <input id="password"  class="password col-lg-12 "type="password" name="password" value="">
                        <button class="unmask" type="button" title="Mask/Unmask password to check content"><i class="eye fas fa-eye"></i></button>
                        <span class="help-block">Veuillez saisir un mot de passe.</span>
                    </div>
                    <button id="btnCo" type="submit" class="margin-both-lg-2 col-lg-8 btn btn-lg btn-secondary" style=" color:#fff;background-color:transparent;border: .05rem solid #fff;">Connexion</button>
                    <div id='insc' class="margin-both-lg-2 col-lg-8">
                        <p style="margin-bottom: 0%">vous n'etes pas encore membre, <strong><a href="$insc">inscrivez-vous.</a> </strong></p>
                        <p>Vous avez <strong><a href="$pssw">oublié votre mot de passe ?</a> </strong></p>
                    </div>
                </div>
            </form>
          </main>

          <footer class="mastfoot">
            <div class="inner">
              <p>Projet personnel.</p>
            </div>
          </footer>

        </div>

      </div>

    </div>
<script>
  FontAwesomeConfig = { searchPseudoElements: true };

  setInterval(function () {
    $('.ninety-four').toggleClass('fas')
    $('.ninety-four').toggleClass('fa-exclamation-triangle')
  }, 1000)
</script>
END;
        return $html;
    }
    public function formInsc($app) {
        $insc = $app->urlFor('sinscrire');
        $urlA = $app->urlFor('accueil');
        $w = $this->content[1];
        $erreur = $this->content[0];
        $warnning = "";
        if ($erreur != "") {
            $warnning = <<<END
                <div id="erreurForm" class="offset-1 col-lg-10 alert alert-danger alert-dismissable ">
                    <i class="fas fa-exclamation"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    $erreur
                </div>
END;
        }
        $html = <<<END

    <div class="site-wrapper ">

      <div class="site-wrapper-inner">

        <div class="cover-container">
          <div class="ombreCo"></div>
          <header class="masthead clearfix">
            <div class="inner">
              <h3  class="masthead-brand" id="Watcher"><a href="$urlA"><img style="float: left;padding-top: 1%" class="col-8" src="theme/ressources/logo.png" ></a></h3>
            </div>
          </header>

          <main  id="FormCo insc"  role="main" class="inner cover">
            <form  onsubmit="return Form.module.submit.start()"  action="$insc" method="post">
                <div class=" row form-group">
                    <h1 class=" col-lg-12 cover-heading formTitle ">S'inscrire</h1>
                    $warnning
                </div>
                <div class="row">
                <h3 class="margin-both-lg-2 col-lg-8">Email *</h3>
                <div class="col-lg-8 margin-both-lg-2">
                     <input id="email" class="col-lg-12" type="email" name="email" value="">
                     <span class="help-block">Veuillez saisir un email.</span>
                </div>
                 <h3 class="margin-both-lg-2 col-lg-8">Pseudo *</h3>
                <div class="col-lg-8 margin-both-lg-2">
                    <input id="pseudo" class="col-lg-12 "type="text" name="pseudo" value="">
                    <span class="help-block">Veuillez saisir un Pseudo.</span>
                </div>
                <h3 class="margin-both-lg-2 col-lg-8">Mot de passe *</h3>
                <div class="col-lg-8 margin-both-lg-2">
                    <input id="password" class="col-lg-12 password "type="password" name="password" value="">
                     <button class="unmask" type="button" title="Mask/Unmask password to check content"><i class="eye fas fa-eye"></i></button>
                    <span class="help-block">Veuillez saisir un mot de passe.</span>
                </div>
                 <h3 class="margin-both-lg-2 col-lg-8">Confirmer le mot de passe *</h3>
                <div class="col-lg-8 margin-both-lg-2">
                    <input id="confirm" class="col-lg-12 password "type="password" name="confirm" value=""> 
                    <button class="unmask" type="button" title="Mask/Unmask password to check content"><i class="eye fas fa-eye"></i></button>
                    <span class="help-block">Veuillez saisir un mot de passe indentique.</span>
                </div>
                <button id="btnCo" type="submit" class="margin-both-lg-2 col-lg-8 btn btn-lg btn-secondary" style=" color:#fff;background-color:transparent;border: .05rem solid #fff;">S'inscrire</button>
                <div class="margin-both-lg-2 col-lg-8">
                    <p>(*) champs <strong>obligatoire.</strong></p>
                </div>
                </div>
            </form>
          </main>

          <footer class="mastfoot" style="width: 100%;position: relative">
            <div class="inner">
                <p>Projet personnel.</p>
            </div>
          </footer>

        </div>

      </div>

    </div>
END;
        return $html;
    }

    public function PasswordForgotBeforeEmail($app) {

        $urlA = $app->urlFor('accueil');
        $co = $app->urlFor('envoyerMail');
        $w = $this->content[1];
        $erreur = $this->content[0];
        $erreur = "";
        $warnning = "";
        if ($erreur != "") {
            $warnning = <<<END
                <div id="erreurForm" class="offset-1 col-lg-10 alert alert-danger alert-dismissable ">
                    <i class="fas fa-exclamation"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    $erreur
                </div>
END;
        }
        $html = <<<END

    <div class="site-wrapper ">

      <div class="site-wrapper-inner">

        <div class="cover-container">
          <div class="ombreCo"></div>
            <header class="masthead clearfix">
                <div class="inner">
                    <h3 style="float: left" class="masthead-brand" id="Watcher"><a href="$urlA"><img style="float: left;padding-top: 1%" class="col-8" src="theme/ressources/logo.png" ></a></h3>
                </div>
            </header>
            <main  id="FormCo"  role="main" class="inner cover">
                <form  onsubmit="return Form.module.submit.start()"  action=$co method="post">
                    <div class=" row form-group">
                        <h1 class=" col-lg-12 cover-heading formTitle ">Mot de passe Oublié</h1>
                        $warnning
                    </div>
                    <div class="row">
                        <h3 class="margin-both-lg-2 col-lg-8">Email *</h3>
                        <div class="col-lg-8 margin-both-lg-2">
                            <input id="email" class="col-lg-12" type="email" name="email" value="">
                            <span class="help-block">Veuillez saisir un email.</span>
                        </div>
                        <button id="btnCo" type="submit" class="margin-both-lg-2 col-lg-8 btn btn-lg btn-secondary" style=" color:#fff;background-color:transparent;border: .05rem solid #fff;">Envoyer un mail</button>
                        <div class="margin-both-lg-2 col-lg-8">
                            <p>(*) champs <strong>obligatoire.</strong></p>
                        </div>
                    </div>
                </form>
            </main>
            <footer class="mastfoot">
                <div class="inner">
                     <p>Projet personnel.</p>
                </div>
            </footer>

        </div>

      </div>

    </div>
END;
        return $html;
    }

    public function PasswordForgotAfterEmail($app) {

        $urlA = $app->urlFor('accueil');
        $co = $app->urlFor('reinitPasswdOK');
        $w = $this->content[1];
        $erreur = $this->content[0];
        $erreur = "";
        $warnning = "";
        if ($erreur != "") {
            $warnning = <<<END
                <div id="erreurForm" class="offset-1 col-lg-10 alert alert-danger alert-dismissable ">
                    <i class="fas fa-exclamation"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    $erreur
                </div>
END;
        }
        $html = <<<END

    <div class="site-wrapper ">

      <div class="site-wrapper-inner">

        <div class="cover-container">
          <div class="ombreCo"></div>
          <header class="masthead clearfix">
            <div class="inner">
              <h3 style="float: left" class="masthead-brand" id="Watcher"><a href="$urlA"><img style="float: left;padding-top: 1%" class="col-8" src="../theme/ressources/logo.png" ></a></h3>
            </div>
          </header>

          <main  id="FormCo"  role="main" class="inner cover">
            <form  onsubmit="return Form.module.submit.start()"  action=$co method="post">
                <div class=" row form-group">
                    <h1 class=" col-lg-12 cover-heading formTitle ">nouveau mot de passe.</h1>
                    $warnning
                </div>
                <h3 class="margin-both-lg-2 col-lg-8">Mot de passe *</h3>
                <div class="col-lg-8 margin-both-lg-2">
                    <input id="password" class="col-lg-12 password "type="password" name="password" value="">
                     <button class="unmask" type="button" title="Mask/Unmask password to check content"><i class="eye fas fa-eye"></i></button>
                    <span class="help-block">Veuillez saisir un mot de passe.</span>
                </div>
                 <h3 class="margin-both-lg-2 col-lg-8">Confirmer le mot de passe *</h3>
                <div class="col-lg-8 margin-both-lg-2">
                    <input id="confirm" class="col-lg-12 password "type="password" name="confirm" value=""> 
                    <button class="unmask" type="button" title="Mask/Unmask password to check content"><i class="eye fas fa-eye"></i></button>
                    <span class="help-block">Veuillez saisir un mot de passe identique.</span>
                </div>
                 <button id="btnCo" type="submit" class="margin-both-lg-2 col-lg-8 btn btn-lg btn-secondary" style=" color:#fff;background-color:transparent;border: .05rem solid #fff;">Confirmer</button>
                    <div class="margin-both-lg-2 col-lg-8">
                    <p>(*) champs <strong>obligatoire.</strong></p>
                </div>
                </div>
            <form>
          </main>

          <footer class="mastfoot">
            <div class="inner">
               <p>Projet personnel.</p>
            </div>
          </footer>

        </div>

      </div>

    </div>
END;
        return $html;
    }

}