<?php
require "/class/Donnee.php";
require "/class/Securise.php";
require "/config.php";
session_start();
<<<<<<< HEAD
require "email_parent.php";
=======
// require "email_parent.php";
>>>>>>> origin/master

if(!isset($_SESSION['paiement']))
{
	header("Location: mauvais_chemin.php");
}
elseif($_SESSION['paiement']==false)
{
	header("Location: mauvais_chemin.php");
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

			<p><strong>Adresse email de l'enfant référent:</strong>
			<?php echo('    '.$_SESSION['email_enf']->get_value());?></p>
			
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

			<p><strong>Participation au diner:</strong>
			<?php if(isset($_SESSION['check_diner']))
						{
							if($_SESSION['check_diner']->get_value()=='on')
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
	
		
			<p><strong> Prix global:</strong>
			<?php echo($_SESSION['prix']);?></p>
			<br>
		</article>
	</body>
</html>