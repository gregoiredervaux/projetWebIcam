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
		<form method="post" action="./formulaire.php">
			<div class="btn-group" role="group">
				<input type="hidden" name="statut" value="parent">
				<input type="submit" class="btn btn-default" value="Je suis un parent d'élève">
			</div>
		</form>

		<form method="post" action="./formulaire.php">
			<div class="btn-group" role="group">
				<input type="hidden" name="statut" value="ingenieur">
				<input type="submit" class="btn btn-default" value="Je suis un ingénieur Icam">
			</div>
		</form>

		</nav>

		<footer>
			<?php include("inclusion/pied_de_page.php") ?>
		</footer>
	</body>
</html>