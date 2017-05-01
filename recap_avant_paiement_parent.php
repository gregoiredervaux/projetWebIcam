<?php
require "/class/Donnee.php";
require "/class/Securise.php";
include ('/config.php');
session_start();

if(!isset($_SESSION['verif']))
{
	header("Location: mauvais_chemin.php");
}
elseif($_SESSION['verif']==false)
{
	header("Location: mauvais_chemin.php");
}

if(isset($_SESSION['modification']))
{
	//verification des données incluses par l'utilisateur
	require "gestion_db/verif_modif_donnee_formulaire.php";
}

if(!isset($_SESSION['prix']))
{
	$prix=0;
	if(isset($_SESSION['check_diner_old']))
	{
		$prix=$prix+$settings['tarifs']['conf'];
	}
	// si il a selectionner le diner on ne lui fait pas payer la conférence
	elseif (isse($_SESSION['check_conference_old']))
	{
		$prix=$prix+$settings['tarifs']['diner'];
	}
	if (isset($_SESSION['nb_ticket_old']))
	{
		$prix=$prix+$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket']->get_value())-$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket_old']->get_value());
	}
	$_SESSION['prix']=$prix;
}
		


var_dump($_SESSION);

?>
<html>
	<head>
		<?php include("inclusion/head.php"); ?>
	</head>
	
	<body>
		<header>
				<?php include("inclusion/entete.php"); ?>
		</header>

		<article class="col-md-10 col-md-offset-1">
		
		<div class="alert alert-success" role="alert">
			<p> Vous êtes autorisé à prendre votre place pour le gala icam !</p>
		</div>

		<h1><strong>Récapitulatif:</strong></h1>
		<br>

			<p><strong>Nom:</strong>
			<?php echo($_SESSION['nom']->get_value());?></p>
			
			<p><strong>Prenom:</strong>
			<?php echo($_SESSION['prenom']->get_value());?></p>
			
			<p><strong>Adresse email personnelle:</strong>
			<?php echo($_SESSION['email']->get_value());?></p>

			<?php
			if (!isset($_SESSION['modification']))
			{ ?>

				<p><strong>Adresse email de l'enfant référent:</strong>
				<?php echo($_SESSION['email_enf']->get_value());?></p>
			<?php } ?>
			
			<p><strong>Telephone:</strong>
			<?php echo($_SESSION['tel']->get_value());?></p>
					
			<p><strong>Participation à la conférence:</strong>
			<?php if(isset($_SESSION['check_conference']))
						{
							if($_SESSION['check_conference']->get_value()=='on' || $_SESSION['check_conference']->get_value()=='1')
							{ ?>
								oui</p>
							<?php }
						else
							{?>
								non</p>
							<?php }
						} ?>

			<p><strong>Participation au diner:</strong>
			<?php if(isset($_SESSION['check_diner']))
						{
							if($_SESSION['check_diner']->get_value()=='on' || $_SESSION['check_diner']->get_value()=='1')
							{ ?>
								oui</p>
							<?php }
						else
							{?>
								non</p>
							<?php }
						} ?>

			<p><strong>Nombre de tickets boisson:</strong>
			<?php echo($_SESSION['nb_ticket']->get_value());?></p>
			<br>
	
		
			<p><strong> Prix global:</strong>
			<?php echo($_SESSION['prix']);?></p>
			<br>

		</article>
		<?php if(isset($_SESSION['modification']))
		{ ?>
			<div class="col-md-offset-1">
				<div class="btn-group" role="group" id="valider">	
					<a href="paiement.php"><button type="button" class="btn btn-default">Payer</button></a>
  					<a href="form_modif_parent.php"><button type="button" class="btn btn-default">Retour au formulaire</button></a>
  				</div>
			</div>
		<?php }
		else
		{ ?>

			<div class="col-md-offset-1">
				<div class="btn-group" role="group" id="valider">	
					<a href="paiement.php"><button type="button" class="btn btn-default">Payer</button></a>
  					<a href="form_parent.php"><button type="button" class="btn btn-default">Retour au formulaire</button></a>
  				</div>
			</div>
		<?php } ?>
	</body>
</html>
