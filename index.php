<?php
require "class/Donnee.php";
session_start();

if (isset($_SESSION['statut']))
{
	echo("session debut d'index");
	var_dump($_SESSION);
}

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
		<form method="post" action="./form_parent.php">
			<div class="btn-group" role="group">
				<input type="hidden" name="statut" value="parent">
				<input type="submit" class="btn btn-default" value="Je suis un parent d'élève">
			</div>
		</form>
		<br>
		<form method="post" action="./form_ingenieur.php">
			<div class="btn-group" role="group">
				<input type="hidden" name="statut" value="ingenieur">
				<input type="submit" class="btn btn-default" value="Je suis un ingénieur Icam">
			</div>
		</form>
		<br>
		<form method="post" action="./form_deja_pris.php">
			<div class="btn-group" role="group">
				<input type="hidden" name="statut" value="deja_pris">
				<input type="submit" class="btn btn-default" value="J'ai déjà pris ma place">
			</div>
		</form>

		</nav>

		<footer>
			<?php include("inclusion/pied_de_page.php") ?>
		</footer>
	</body>
</html>