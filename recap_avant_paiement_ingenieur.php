<?php
require "/class/Donnee.php";
require "/class/Securise.php";
include ('/config.php');
session_start();

if(!isset($_SESSION['verif']))
{
	header("Location: mauvais_chemin.php");
	exit();
}
elseif($_SESSION['verif']==false)
{
	header("Location: mauvais_chemin.php");
	exit();
}

if(isset($_SESSION['statut_inv']))
{
	if($_SESSION['statut_inv']=='empty' && isset($_SESSION['nom_inv']))
	{
		if($_SESSION['nom_inv']->get_value()!='')
			{
				$_SESSION['statut_inv']='new';
			}
	}
}

if(isset($_SESSION['modification']))
{
	//verification des données incluses par l'utilisateur
	require "gestion_db/verif_modif_donnee_formulaire.php";
}

if(!isset($_SESSION['prix']))
{
	$prix=0;
	if(isset($_SESSION['check_conference_old']))
	{
		// echo(" conférence ");
		$prix=$prix+$settings['tarifs']['conf'];
		// echo($prix);
	}
	if (isset($_SESSION['nb_ticket_old']))
	{
		// echo(" ancien ticket ingé ");
		$prix=$prix+$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket']->get_value())-$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket_old']->get_value());
		// echo($prix);
	}
	if (isset($_SESSION['nb_ticket_inv_old']))
	{
		// echo(" ancien ticket inv ");
		$prix=$prix+$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket_inv']->get_value())-$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket_inv_old']->get_value());
		// echo($prix);
	}
	if(isset($_SESSION['statut_inv']))
	{
		if ($_SESSION['statut']=='new')
		{
			// echo(" place+nouv ticket");
			// if($_SESSION['nom_inv']->get_value()!=)
			$prix=$prix+$settings['tarifs']['place'];
			$prix=$prix+$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket_inv']->get_value());
			// echo($prix);
		}
	}
	$_SESSION['prix']=$prix;
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

		<article>
		
			<div class="alert alert-success" role="alert">
				<p> Vous êtes autorisé à prendre votre place pour le gala icam !</p>
			</div>
			
			

			<div class="col-md-10 col-md-offset-1">

				<h1><Strong>Récapitulatif:</Strong></h1>
				<br>
				
				<p><strong>Nom:</strong>
				<?php echo('    '.$_SESSION['nom']->get_value());?></p>
				
				<p><strong>Prenom:</strong>
				<?php echo('    '.$_SESSION['prenom']->get_value());?></p>
				
				<p><strong>Adresse email personnelle</strong>
				<?php echo('    '.$_SESSION['email']->get_value());?></p>
				
				<p><strong>Telephone:</strong>
				<?php echo('    '.$_SESSION['tel']->get_value());?></p>
						
				<p><strong>Participation à la conférence:</strong>
				<?php if(isset($_SESSION['check_conference']))
							{
								if($_SESSION['check_conference']->get_value()=='on' || $_SESSION['check_conference']->get_value()=='1')
								{ ?>
									oui</p>
								<?php }
							}
							else
								{?>
									non</p>
								<?php } ?>

				<p><strong>Nombre de tickets boisson:</strong>
				<?php echo($_SESSION['nb_ticket']->get_value());?></p>
				<br>
					<?php if(!isset($_SESSION['pas_inv']))
					{?>
						<p><strong>Nom de l'invité:</strong>
						<?php echo($_SESSION['nom_inv']->get_value());?></p>
						
						<p><strong>Prenom de l'invité:</strong>
						<?php echo($_SESSION['prenom_inv']->get_value());?></p>

						<p><strong>Telephone de l'invité:</strong>
						<?php echo($_SESSION['tel_inv']->get_value());?></p>

						<p><strong>Nombre de tickets boisson de l'invité:</strong>
						<?php echo($_SESSION['nb_ticket_inv']->get_value());?></p>
					<?php
				}
					elseif($_SESSION['pas_inv']!=true)
					{ ?>
						<p><strong>Nom de l'invité:</strong>
						<?php echo($_SESSION['nom_inv']->get_value());?></p>
						
						<p><strong>Prenom de l'invité:</strong>
						<?php echo($_SESSION['prenom_inv']->get_value());?></p>

						<p><strong>Telephone de l'invité:</strong>
						<?php echo($_SESSION['tel_inv']->get_value());?></p>

						<p><strong>Nombre de tickets boisson de l'invité:</strong>
						<?php echo($_SESSION['nb_ticket_inv']->get_value());?></p>
					<?php } ?>
				
				<p><strong>Prix global:</strong>
				<?php echo($_SESSION['prix']);?></p>
				<br>

				</div>
				<?php if(isset($_SESSION['modification']))
				{ ?>
					<div class="col-md-offset-1">
					<div class="btn-group" role="group" id="valider">	
						<a href="paiement.php"><button type="button" class="btn btn-default">
							<?php if($_SESSION['prix']==0)
							{ ?>Modifier<?php }
							else
							{
								?>Payer<?php } ?></button></a>
  						<a href="form_modif_ingenieur.php"><button type="button" class="btn btn-default">Retour au formulaire</button></a>
  					</div>
				</div>
				<?php }
				else
				{ ?>

				<div class="col-md-offset-1">
					<div class="btn-group" role="group" id="valider">	
						<a href="paiement.php"><button type="button" class="btn btn-default">
						<?php if($_SESSION['prix']==0)
							{ ?>Modifier<?php }
							else
							{
								?>Payer<?php } ?></button></a>
  						<a href="form_ingenieur.php"><button type="button" class="btn btn-default">Retour au formulaire</button></a>
  					</div>
				</div>
				<?php } ?>

		</article>

			
	</body>
</html>