<?php 
require "config.php";
require "fonctions_db.php";

include 'inclusion/header.php';

$_SESSION=array('email_admin' => $_SESSION['email_admin']);

try
{
  $bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
  die('erreur:'.$e->getMessage());
}

if (isset($_GET['del_invite'])){
	$garant=findIcamGarant($_GET['del_invite'], $bd, $settings);
	if ($garant[0]==$garant[1]){	//cas ou on supprime un icam/inge , peut être réadapté a une utilisation avec étudiants icam dans la bdd (on a fait ici le cas très général)
		$id_suppr=$bd->query('SELECT * FROM '.$settings['confSQL']['bd_'.$garant[2].'_has_guest'].' WHERE id_'.$garant[2].'='.$garant[1]);
		$bd->query('DELETE FROM '.$settings['confSQL']['bd_'.$garant[2].'_has_guest'].' WHERE id_'.$garant[2].'='.$garant[1]);
		foreach($id_suppr->fetch() as $id){
			$bd->query('DELETE FROM '.$settings['confSQL']['bd_invite'].' WHERE id='.$id);
			?><div class="alert alert-danger" role="alert">
    	<p>L'invité #<?php echo $_GET['del_invite'] ?> a bien été supprimé</p>
  		</div>
  		<?php
		}
	}
	elseif ($garant[2]=='inge'){	// cas invite d'un ingénieur
		$bd->query('DELETE FROM '.$settings['confSQL']['bd_inge_has_guest'].' WHERE id_invite='.$garant[0]);
		$bd->query('DELETE FROM '.$settings['confSQL']['bd_invite'].' WHERE id='.$garant[0]);
		?><div class="alert alert-danger" role="alert">
    	<p>L'invité #<?php echo $_GET['del_invite'] ?> a bien été supprimé</p>
  		</div>
  		<?php
		
	}
	else{		// cas d'un parent
		$id_parent=$bd->query('SELECT id_parent1, id_parent2 FROM '.$settings['confSQL']['bd_icam_has_guest']);	//parent2
		foreach($id_parent->fetchall() as $parent){
			if ($_GET['del_invite']==$parent['id_parent2']){
				$bd->query('UPDATE '.$settings['confSQL']['bd_icam_has_guest'].' SET id_parent2=\'NULL\' WHERE id_parent2='.$garant[0]);
				break;
			}
			elseif($_GET['del_invite']==$parent['id_parent1']){
				if ($parent['id_parent2']==0){
					$bd->query('DELETE FROM '.$settings['confSQL']['bd_icam_has_guest'].' WHERE id_parent1='.$_GET['del_invite']);
					break;
				}
				else{
					$bd->query('UPDATE '.$settings['confSQL']['bd_icam_has_guest'].' SET id_parent1='.$parent['id_parent2'].' WHERE id_parent1='.$parent['id_parent1']);
					$bd->query('UPDATE '.$settings['confSQL']['bd_icam_has_guest'].' SET id_parent2=\'NULL\' WHERE id_parent1='.$parent['id_parent2']);
					break;


				}
			}
		}
		$bd->query('DELETE FROM '.$settings['confSQL']['bd_invite'].' WHERE id='.$_GET['del_invite']);
		?><div class="alert alert-danger" role="alert">
    	<p>L'invité <?php echo $_GET['del_invite'] ?> a bien été supprimé</p>
  		</div>
  		<?php
	}
}
if (!isset($_POST['recherche'])){	//pas de recherche, on affiche tout le monde
	$liste_invite=$bd->query('SELECT id, nom, prenom, email, telephone, ticket_boisson, promo, date_inscription, diner, conference FROM '.$settings['confSQL']['bd_invite']);
}
else{								//cas d'une recherche
	$liste_invite=$bd->query('SELECT id, nom, prenom, email, telephone, ticket_boisson, promo, date_inscription, diner, conference FROM '.$settings['confSQL']['bd_invite'].' WHERE nom LIKE \'%'.$_POST['recherche'].'%\' OR prenom LIKE \'%'.$_POST['recherche'].'%\'');

}
?>
<html>
	<body>
		<container>
			<div class="row"><h3 class="col-md-offset-1 col-md-7"><strong>Liste des participants au Gala</strong></h3>
			</div>
			<form action="liste_invite.php" method="post">
			<section class="row" id="recherche">
				<div class= "col-md-offset-1 col-md-3">
					<input type="input-medium search-query" class="form-control" name="recherche" placeholder="Nom, prenom..."
					<?php if (isset($_POST['recherche']))
					{?> 
					value=<?php echo($_POST['recherche']);
				}?> >
				</div>
				<div class=col-md-4>
					<button class="btn btn-primary" type="submit">Rechercher</button>
				</div>
				<a href="form_ingenieur.php" class="btn btn-primary">Ajouter un ingénieur</a>
				<a href="form_parent.php" class="btn btn-primary">Ajouter un parent</a>
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
								<td><strong>Conference</strong></td>
								<td><strong>Diner</strong></td>
								<td><strong>Promo</strong></td>
								<td><strong>Invité</strong></td>
								<td><strong>Date Inscription</strong></td>
								<td><strong>Editer</strong></td>

							</tr>
							<?php 
							foreach ($liste_invite->fetchall() as $d){
								?>
								<tr>
									<td><?php echo($d['nom']) ?></td>
									<td><?php echo($d['prenom']) ?></td>
									<td><?php echo($d['email']) ?></td>
									<td>0<?php echo($d['telephone']) ?></td>
									<td><span class="label label-info"><?php echo($d['ticket_boisson']) ?></span></td>

									<td><?php if ($d['conference']==1){ ?><span class="label label-success">1</span> <?php }
												else{ ?><span class="label label-danger">0</span><?php } ?></td>
									<td><?php if ($d['diner']==1){ ?><span class="label label-success">1</span> <?php }
												else{ ?><span class="label label-danger">0</span><?php } ?></td>

									<td><?php if (isset($d['promo'])){echo($d['promo']);}else{echo('Invité');} ?></td>
									<td><?php if ($d['promo']=='parent'){
											$enfant=$bd->query('SELECT nom, prenom FROM '.$settings['confSQL']['bd_etudiant_icam'].' INNER JOIN '.$settings['confSQL']['bd_parent'].' ON '.$settings['confSQL']['bd_etudiant_icam'].'.id='.$settings['confSQL']['bd_parent'].'.id_icam WHERE '.$d['id'].'='.$settings['confSQL']['bd_parent'].'.id_parent1 OR '.$d['id'].'='.$settings['confSQL']['bd_parent'].'.id_parent2');
											$referent=$enfant->fetch();
											echo($referent[0].' '.$referent[1].' (icam)');
											} 
											elseif ($d['promo']==''){
											$invite_inge=$bd->query('SELECT nom, prenom FROM '.$settings['confSQL']['bd_invite'].' INNER JOIN '.$settings['confSQL']['bd_inge_has_guest'].' ON '.$settings['confSQL']['bd_invite'].'.id='.$settings['confSQL']['bd_inge_has_guest'].'.id_inge WHERE '.$d['id'].'='.$settings['confSQL']['bd_inge_has_guest'].'.id_invite');
											$referent_inge=$invite_inge->fetch();
											echo($referent_inge[0].' '.$referent_inge[1].' (icam)');
											} 
											else{
											$invite_inge=$bd->query('SELECT nom, prenom FROM '.$settings['confSQL']['bd_invite'].' INNER JOIN '.$settings['confSQL']['bd_inge_has_guest'].' ON '.$settings['confSQL']['bd_invite'].'.id='.$settings['confSQL']['bd_inge_has_guest'].'.id_invite WHERE '.$d['id'].'='.$settings['confSQL']['bd_inge_has_guest'].'.id_inge');
											$referent_inge=$invite_inge->fetch();
											echo($referent_inge[0].' '.$referent_inge[1]);

											}
											?></td>
									<td><?php echo($d['date_inscription']) ?></td>
									<td>
									<a href="gestion_db/verif_enreg_deja_pris.php?id=<?php echo($d['id'])?>" title="Editer l'utilisateur #<?php echo($d['id'])?>"><i class="glyphicon glyphicon-edit"></i></a>
							      	<a href="liste_invite.php?del_invite=<?php echo $d['id']; ?>" title="Supprimer l'utilisateur #<?php echo $d['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet invité et ses invités ?');"><i class="glyphicon glyphicon-trash"></i></a>              

				      				</td>
								</tr>

							<?php } ?>
						</table>
					</div>
				</section>
			</div>

		</container>
	</body>
	<footer>
		<?php include "inclusion/footer.html" ?>
	</footer>
</html>