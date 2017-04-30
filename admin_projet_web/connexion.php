<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="Guillaume/Grégoire" content="Site admin gala">
    <link rel="icon" href="../../favicon.ico">

    <title>Connexion admin gala</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </head>

  <body>

    <div class="container">
      <!-- <form class="form-signin" method="POST" action="./index2.php">
        <h2 class="form-signin-heading">Connectez-vous!</h2>
        <input type="email" class="form-control" placeholder="Adresse mail" name="mail" required autofocus>
        <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
        <input class="btn btn-primary" type="submit" value="Se connecter">
      </form> -->
      <form class="form-signin" role="form" action="index2.php" method="post">
          <h2 class="form-signin-heading">Identifiez-vous !</h2>
          <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        </form>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>