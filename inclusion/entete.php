<!DOCTYPE html>
<html lang="fr">
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="./index.php">Gala Icam</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="./index.php">Accueil</a></li> 
            <?php if (isset($_SESSION['statut'])){
            ?>
              <li><a href="./formulaire.php">Formulaire</a></li>
            <?php }?>
            
          </ul>
        </div>
      </div>
    </nav>
</html>