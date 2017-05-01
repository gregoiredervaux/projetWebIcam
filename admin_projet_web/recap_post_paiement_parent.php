<?php
require "/class/Donnee.php";
require "/class/Securise.php";
require "/config.php";
include("inclusion/header.php");
?>
<!DOCTYPE html>
<html>
	
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

		<p><strong>Mot de passe:</strong>
		<?php echo($_SESSION['psw']);?><p>
		<br>
		
		<h1><strong>Récapitulatif:</strong></h1>
		<br>

			<p><strong>Nom:</strong>
			<?php echo('    '.$_SESSION['nom']->get_value());?></p>
			
			<p><strong>Prenom:</strong>
			<?php echo('    '.$_SESSION['prenom']->get_value());?></p>
			
			<p><strong>Adresse email personnelle:</strong>
			<?php echo('    '.$_SESSION['email']->get_value());?></p>

			<?php
			if (!isset($_SESSION['modification']))
			{ ?>

				<p><strong>Adresse email de l'enfant référent:</strong>
				<?php echo($_SESSION['email_enf']->get_value());?></p>
			<?php } ?>
			
			<p><strong>Telephone:</strong>
			<?php echo('    '.$_SESSION['tel']->get_value());?></p>
					
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
		</article>
	</body>
</html>