<?php
require "/class/Donnee.php";
require "/class/Securise.php";
include ('/config.php');
session_start();

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

		<p> Identifiaction: (si vous voulez modifier votre place, vous aurez besoin de ces deux informations !)</p>
		<br>

		<p>Identifiant:</p>
		<p><?php echo($_SESSION['email']->get_value());?><p>
		<br>

		<p>Mot de passe:<p>
		<p><?php echo($_SESSION['psw']);?><p>
		<br>
		
		<p> <Strong>Récaputilatif:</Strong></p>
		<br>
		
		<p> Noms:</p>
		<p><?php echo($_SESSION['nom']->get_value());?><p>
		<br>
		
		<p>Prenom:</p>
		<p><?php echo($_SESSION['prenom']->get_value());?></p>
		<br>
		
		<p>Adresse email personnelle</p>
		<p><?php echo($_SESSION['email']->get_value());?></p>
		<br>
		
		<p>Telephone:</p>
		<p><?php echo($_SESSION['tel']->get_value());?></p>
		<br>
				
		<p>Paricipation à la conférence:</p>
		<p><?php if(isset($_SESSION['check_conference']))
					{if($_SESSION['check_conference']=='on')
						{ ?>
							<p>oui</p>
						<?php }
					}
					else
						{ ?>
							<p>non</p>
						<?php } ?></p>
		<br>
		
		<p>Nombre de tickets boisson:</p>
		<p><?php echo($_SESSION['nb_ticket']->get_value());?></p>
		<br>

		<p> Noms de l'invité:</p>
		<p><?php echo($_SESSION['nom_inv']->get_value());?><p>
		<br>
		
		<p>Prenom de l'invité:</p>
		<p><?php echo($_SESSION['prenom_inv']->get_value());?></p>
		<br>

		<p>Telephone de l'invité:</p>
		<p><?php echo($_SESSION['tel_inv']->get_value());?></p>
		<br>

		<p>Nombre de tickets boisson de l'invité:</p>
		<p><?php echo($_SESSION['nb_ticket_inv']->get_value());?></p>
		<br>
		
		<p>Prix global:</p>
		<p><?php echo($_SESSION['prix']);?></p>
		
		</article>
	</body>
</html>