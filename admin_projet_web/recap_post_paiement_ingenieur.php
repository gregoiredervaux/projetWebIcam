<?php
require "/class/Donnee.php";
require "/class/Securise.php";
include ('/config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("inclusion/header.php");

?>
	</head>
	
	<body>
		<article>
		
		<div class="alert alert-success" role="alert">
			<p> Paiement effectué ! Votre place a bien été enregistrée</p>
		</div>

		<div class="col-md-10 col-md-offset-1">

		<h1><strong> Identification:</strong></h1><p>(si vous voulez modifier votre place, vous aurez besoin de ces deux informations !)</p>
		<br>

		<p><strong>Identifiant:</strong>
		<?php echo($_SESSION['email']->get_value());?><p>
		<br>
			
			<h1> <Strong>  Récapitulatif:</Strong></h1>

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
								if($_SESSION['check_conference']->get_value()=='on')
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

				<?php if($_SESSION['statut']!='empty')
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
			
				<br>

			</div>
		
		</article>
	</body>
</html>