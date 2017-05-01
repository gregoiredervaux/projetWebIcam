<?php 
require "config.php";
require "fonctions_db.php";
session_start();
if (!isset($_SESSION['email'])){	//verifie autorisation
	$_SESSION=array('erreur'=>'Vous devez vous connecter pour accéder à cette page!');
	header('Location: connexion.php');
}
include 'inclusion/header.php';
try
{
  $bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
  die('erreur:'.$e->getMessage());
}
if (!empty($_GET)){
	$id=findIcamGarant($_GET['id'], $bd, $settings);
	$invite=$bd->query('SELECT * FROM '.$settings['confSQL']['bd_invite'].' WHERE id='.$_GET['id']);
	$info_invite=$invite->fetch();
}
?>
<!DOCTYPE html>
<html>
	<body>
	<container>
	<div class="col-md-offset-1 col-md-5">
		<form method="post" action="edit_invite.php">
			<fieldset>
			<legend>Votre Place</legend>
				

				<div class="input-group" id="promo">
		  		<span class="input-group-addon" id="sizing-addon2">promotion</span>
				<input type="text" class="form-control" aria-describedby="sizing-addon2" name="promo">
				</div>
				<br>
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
			  		<input type="text" class="form-control" placeholder="email.personnel@exple.fr" aria-describedby="sizing-addon2" name="email">
				</div>
				<br>
				<div class="input-group" id='telephone'>
			  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
			  		<input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2" name="tel">
				</div>
				<br>
				<div class="checkbox">
      				<label><input type="checkbox" name="check_conference">Participation à la conférence <span class="label label-primary">+ 3€</span></label>
      			</div>
      			<br>
				<div>
      			<label for="nb_ticket">combien de tickets boissons voulez vous ? <span class="label label-primary">+ 1€/ticket</span></label><br />
		       <select name="nb_ticket" id="pays">

		           <option value=0>0</option>

		           <option value=10>10</option>

		           <option value=20>20</option>

		           <option value=30>30</option>

		           <option value=40>40</option>

		           <option value=50>50</option>

		       </select>
		    <br>
		    <br>
		    </div>
			</fieldset>

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
				<div class="input-group" id='telephone'>
			  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
			  		<input type="text" class="form-control" placeholder="Telephone invité" aria-describedby="sizing-addon2" name="tel_inv">
				</div>
				<br>
				<div>
      		<label for="nb_ticket">combien de tickets boissons voulez vous pour votre invité(e) ? <span class="label label-primary">+ 1€/ticket</span></label><br />

		       <select name="nb_ticket_inv" id="pays">

		           <option value=0 >0</option>

		           <option value=10 >10</option>

		           <option value=20 >20</option>

		           <option value=30 >30</option>

		           <option value=40 >40</option>

		           <option value=50 >50</option>

		       </select>
		    </div>
		    <br>
			</fieldset>
			<div class="btn-group" role="group" id="valider">
				<a href="gestion_db/verif_enreg_ingenieur.php"><input type="submit" class="btn btn-default" value="valider"></a>
			</div>
			<br>
			<br>
		</form>
	</div>
	</container>
	</body>
	<footer>
		<?php include "inclusion/footer.html" ?>
	</footer>
</html>