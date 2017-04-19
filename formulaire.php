<?php
session_start();
if (isset($_POST['statut']))
{
	$_SESSION['statut']=$_POST['statut'];
}
elseif  (!isset($_SESSION['statut']))
{
	header('./index.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("inclusion/head.php"); ?>
		<?php include("inclusion/entete.php"); ?>
	</head>
	<fieldset>
	<legend>Votre Place</legend>
	<form method="post" action="gestion_db/enregistrement_db.php">
		<div class="input-group" id="nom">
  		<span class="input-group-addon" id="sizing-addon2">Nom</span>
		<input type="text" class="form-control" aria-describedby="sizing-addon2">
		</div>
		<br>
		<div class="input-group" id='prenom'>
	  		<span class="input-group-addon" id="sizing-addon2">Prénom</span>
	  		<input type="text" class="form-control" aria-describedby="sizing-addon2">
		</div>
		<br>
		<div class="input-group" id="mail">
	  		<span class="input-group-addon" id="sizing-addon2">@</span>
	  		<input type="text" class="form-control" placeholder="Adresse email" aria-describedby="sizing-addon2">
		</div>
		<br>
		<?php if ($_SESSION['statut']=="parent"){
		?>
			<div class="input-group" id="mail">
	  			<span class="input-group-addon" id="sizing-addon2">@</span>
	  			<input type="text" class="form-control" placeholder="Adresse email de l'enfant référent" aria-describedby="sizing-addon2">
			</div>
			<br>
		<?php }?>
		<div class="input-group" id='telephone'>
	  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
	  		<input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2">
		</div>
		<br>
	</form>
	</fieldset>
	<?php if ($_SESSION['statut']=="ingenieur"){
		?>
	<fieldset>
	<legend>Place invité</legend>
	<form method="post" action="gestion_db/enregistrement_db.php">
		<div class="input-group" id="nomInvit">
  		<span class="input-group-addon" id="sizing-addon2">Nom</span>
		<input type="text" class="form-control" aria-describedby="sizing-addon2">
		</div>
		<br>
		<div class="input-group" id='prenomInvit'>
	  		<span class="input-group-addon" id="sizing-addon2">Prénom</span>
	  		<input type="text" class="form-control" aria-describedby="sizing-addon2">
		</div>
		<br>
		<div class="input-group" id="mailInvit">
	  		<span class="input-group-addon" id="sizing-addon2">@</span>
	  		<input type="text" class="form-control" placeholder="Adresse email invité" aria-describedby="sizing-addon2">
		</div>
		<br>
		<div class="input-group" id='telephone'>
	  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
	  		<input type="text" class="form-control" placeholder="Telephone invité" aria-describedby="sizing-addon2">
		</div>
		<br>
	</form>
	</fieldset>
	<?php }?>

</html> 	