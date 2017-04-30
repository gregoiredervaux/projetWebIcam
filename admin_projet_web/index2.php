<?php 
require "config.php";
require "Auth_class.php";
session_start();
if (!isset($_SESSION['email'])){	//verifie autorisation
	header('Location: connexion.php');
}
include 'header.php';

try
{
  $bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
  die('erreur:'.$e->getMessage());
}

if (!isset($_POST['recherche'])){
	$liste_invite=$bd->query('SELECT nom, prenom, email, telephone, ticket_boisson, promo, date_inscription, diner, conference FROM '.$settings['confSQL']['bd_invite']);
}
else{
	$liste_invite=$bd->query('SELECT nom, prenom, email, telephone, ticket_boisson, promo, date_inscription, diner, conference FROM '.$settings['confSQL']['bd_invite'].' WHERE nom LIKE %'.$_POST['recherche'].'% AND prenom LIKE %'.$_POST['recherche'].'%');
}
?>
<html>
	<body>
		<container>
			<div class="row"><h3 class="col-md-offset-1 col-md-11"><strong>Liste des participants au Gala</strong></h3></div>
			<form action="index2.php" method="post">
			<section class="row" id="recherche">
				<div class= "col-md-offset-1 col-md-3">
					<input type="input-medium search-query" class="form-control" name="recherche" placeholder="Nom, prenom...">
				</div>
				<div class=col-md-2>
					<button class="btn btn-primary" type="submit">Rechercher</button>
				</div>
			</section>
			</form>
			<br>
				<section class="row" id="tableau">
					<div class="col-md-offset-1 col-md-10">
						<table class="table table-striped">
							<tr>
								<td><strong>Nom</strong></td>
								<td><strong>Prénom</strong></td>
								<td><strong>Email</strong></td>
								<td><strong>Telephone</strong></td>
								<td><strong>Tickets Boissons</strong></td>
								<td><strong>Promo</strong></td>
								<td><strong>Date Inscription</strong></td>
							</tr>
							<?php 
							foreach ($liste_invite->fetchall() as $d){ ?>
								<tr>
									<td><?php echo($d['nom']) ?></td>
									<td><?php echo($d['prenom']) ?></td>
									<td><?php echo($d['email']) ?></td>
									<td>0<?php echo($d['telephone']) ?></td>
									<td><?php echo($d['ticket_boisson']) ?></td>
									<td><?php echo($d['promo']) ?></td>
									<td><?php echo($d['date_inscription']) ?></td>
								</tr>

							<?php } ?>
						</table>
					</div>
				</section>
			</div>
		</container>
	</body>
</html>