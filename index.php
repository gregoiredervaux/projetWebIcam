<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("inclusion/head.php"); ?>
	</head>

	<body>
		<header>
			<?php include("inclusion/entete.php"); ?>
		</header>

		<section>
			
		</section>

		<nav>
		  <div class="btn-group" role="group" id="parent">
		    <a href="formulaire.php"><button type="button" class="btn btn-default">Parent</button></a>
		    <?php $_SESSION['statut']="parent";?>
		  </div>
		  <div class="btn-group" role="group" id="ingenieur">
		    <a href="formulaire.php"><button type="button" class="btn btn-default">Ingenieur</button></a>
		    <?php $_SESSION['statut']="ingenieur";?>
		  </div>
		</nav>

		<footer>
			<?php include("inclusion/pied_de_page.php") ?>
		</footer>
	</body>
</html>