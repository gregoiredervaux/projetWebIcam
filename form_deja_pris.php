<?php
require "class/Donnee.php";
session_start();

if (isset($_POST['statut']) && $_POST['statut']=='deja_pris')
{
	if (isset($_SESSION['statut']))
	{
		if ($_SESSION['statut']->get_value()!=$_POST['statut'])
		{
			//si la session est autre que ce que dit le POST, c'est qu'il à déjà visiter un autre formulaire, donc on reinitilaise la session
			$_SESSION=array();
		}
	}
	$_SESSION['statut']=new Donnee ('deja_pris','statut');
}
else
{
	header('./index.php');
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
		<form method="post" action="gestion_db/verif_enreg_deja_pris.php" class="col-md-offset-1 col-md-5">
		
		<?php if (isset($_SESSION['erreur']['id_place']))
					{ 
						if ($_SESSION['erreur']['id_place']->get_value()=='')
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> le champs "Identifiant" n'est pas remplis</p>
							</div>
						<?php }
						else
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> <?php echo($_SESSION['erreur']['id_place']->get_value())?> n'est pas un numéro de place valide </p>
							</div>
						<?php } ?>
					<?php } 
				if(isset($_SESSION['erreur']['psw']))
					{
						if ($_SESSION['erreur']['psw']->get_value()=='')
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> le champs "mot de passe" n'est pas remplis</p>
							</div>
						<?php }
						else
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> le mot de passe rentré contient des caractères spéciaux non-admis</p>
							</div>
						<?php } ?>
					<?php }
				if(isset($_SESSION['erreur']['bool_mauvais_psw']))
					{
						if ($_SESSION['erreur']['bool_mauvais_psw']->get_value()==true)
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> le mot de passe ou l'identifiant n'est pas le bon !</p>
							</div>
						<?php }
						else
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> le mot de passe rentré contient des caractères spéciaux non-admis</p>
							</div>
						<?php } ?>
					<?php } ?>


		<fieldset>
			<div class="input-group" id='id_place'>
		  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		  		<input type="text" class="form-control" placeholder="Identifiant" aria-describedby="sizing-addon2" name="email"
		  		<?php if (isset($_SESSION['email']))
				{?> 
					value=<?php echo($_SESSION['email']->get_value());
				}?> >
			</div>
			<br>

			<div class="input-group" id='id_place'>
		  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
		  		<input type="password" class="form-control" placeholder="mot de passe" aria-describedby="sizing-addon2" name="psw">
			</div>
			<br>
		</fieldset>
		
		<div class="btn-group" role="group" id="valider">
			<a href="gestion_db/verif_enreg_deja_pris.php"><input type="submit" class="btn btn-default" value="Rechercher"></a>
		</div>
		<br/>
		<br/>
		<br/>
		</form>
		<footer>
			<?php include("inclusion/pied_de_page.php"); ?>
		</footer>
	</body>
</html>