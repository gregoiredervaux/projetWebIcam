<!DOCTYPE html>
<html lang="fr">
    <link href="bootstrap/css/main.css" rel="stylesheet">
    <nav class="navbar navbar-fixed-top navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="./index.php">Gala Icam</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="./index.php">Accueil</a></li> 
            <?php if (isset($_SESSION['statut'])&&$_SESSION['statut']->get_value()=='parent')
            {?>
              <li><a href="form_parent.php">Formulaire</a></li>
            <?php }
            elseif (isset($_SESSION['statut'])&&$_SESSION['statut']->get_value()=='ingenieur')
            {?>
              <li><a href="form_ingenieur.php">Formulaire</a></li>
            <?php }
            elseif (isset($_SESSION['statut'])&&$_SESSION['statut']->get_value()=='deja_pris')
            {?>
              <li><a href="form_deja_pris.php">Formulaire</a></li>
            <?php }?>
          </ul>
        </div>
      </div>
    </nav>
</html>