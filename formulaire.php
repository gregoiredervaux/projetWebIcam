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
	<form method="post" action="gestion_db/enregistrement_db.php">
	<fieldset>
	<legend>Votre Place</legend>
		<div class="input-group" id="nom">
  		<span class="input-group-addon" id="sizing-addon2">Nom</span>
		<input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom">
		</div>
		<br>
		<div class="input-group" id='prenom'>
	  		<span class="input-group-addon" id="sizing-addon2">Prénom</span>
	  		<input type="text" class="form-control" aria-describedby="sizing-addon2" name="prenom">
		</div>
		<br>
		<div class="input-group" id="mail">
	  		<span class="input-group-addon" id="sizing-addon2">@</span>
	  		<input type="text" class="form-control" placeholder="Adresse email" aria-describedby="sizing-addon2" name="email">
		</div>
		<br>
		<?php if ($_SESSION['statut']=="parent"){
		?>
			<div class="input-group" id="mail">
	  			<span class="input-group-addon" id="sizing-addon2">@</span>
	  			<input type="text" class="form-control" placeholder="Adresse email de l'enfant référent" aria-describedby="sizing-addon2" name="email_enf">
			</div>
			<br>
		<?php }?>
		<div class="input-group" id='telephone'>
	  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
	  		<input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2" name="tel">
		</div>
		<br>
	</fieldset>
	<?php if ($_SESSION['statut']=="ingenieur"){
		?>
	<fieldset>
	<legend>Place invité</legend>
		<div class="input-group" id="nomInvit">
  		<span class="input-group-addon" id="sizing-addon2">Nom</span>
		<input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom_inv">
		</div>
		<br>
		<div class="input-group" id='prenomInvit'>
	  		<span class="input-group-addon" id="sizing-addon2">Prénom</span>
	  		<input type="text" class="form-control" aria-describedby="sizing-addon2" name="prenom_inv">
		</div>
		<br>
		<div class="input-group" id="mailInvit">
	  		<span class="input-group-addon" id="sizing-addon2">@</span>
	  		<input type="text" class="form-control" placeholder="Adresse email invité" aria-describedby="sizing-addon2" name="prenom_inv">
		</div>
		<br>
		<div class="input-group" id='telephone'>
	  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
	  		<input type="text" class="form-control" placeholder="Telephone invité" aria-describedby="sizing-addon2" name="tel_inv">
		</div>
		<br>
	</fieldset>
	<?php }?>
	<div class="btn-group" role="group" id="valider">
		<a href="gestion_db/enregistrement_db.php"><input type="submit" class="btn btn-default" value="valider"></a>
	</div>
	</form>
</html> 	