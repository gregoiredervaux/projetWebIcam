<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Admin Gala Icam</title>
		<meta name="description" content="Site de présentation du gala">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/Art.ico">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

    	<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
  <?php 
    session_start();
    if (!isset($_SESSION['email_admin'])){  //verifie autorisation
      $_SESSION=array('erreur'=>'Vous devez vous connecter pour accéder à cette page!');
      header('Location: connexion.php');
      exit();
    }
      require "config.php";
      try
    {
      $bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    }
    catch(Exeption $e)
    {
      die('erreur:'.$e->getMessage());
    } 
    ?>


    <nav class="navbar navbar-fixed-top navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="./liste_invite.php">Gala Icam</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="./liste_invite.php">Accueil</a></li> 
          </ul>
          <ul class="nav navbar-nav">
            <li><a href="./parametre.php">Paramètres</a></li> 
          </ul>
          <ul class="nav navbar-nav navbar-right">     
            <li><a href="deconnexion.php">Deconnexion</a></li> 
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <li><a><em><?php 
                      $name=$bd->prepare('SELECT prenom FROM '.$settings['confSQL']['bd_admin'].' WHERE email=\''.$_SESSION['email_admin'].'\'');
                      $name->execute();
                      $affichage=$name->fetch();
                      echo ($affichage[0]);?></em></a></li>
          </ul>
        </div>
      </div>
    </nav>
</html>