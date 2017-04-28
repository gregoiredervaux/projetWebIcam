<?php
require "/class/Donnee.php";
require "/class/Securise.php";
include ('/config.php');
session_start();

echo($_SESSION['verif']);

if(!isset($_SESSION['verif']))
{
	header("Location: mauvais_chemin.php");
}
elseif($_SESSION['verif']==true)
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
			<p> Vous êtes autorisé à prendre votre place pour le gala icam !</p>
		</div>
		
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
		
		<p>Paricipation au diner:</p>
		<p><?php if(isset($_SESSION['check_diner']))
					{if($_SESSION['check_diner']=='on')
						{
							echo("oui");
						}
					}
					else
						{
							echo("non");
						}?></p>
		<br>
		
		<p>Paricipation à la conférence:</p>
		<p><?php if(isset($_SESSION['check_conference']))
					{if($_SESSION['check_conference']=='on')
						{
							echo("oui");
						}
					}
					else
						{
							echo("non");
						}?></p>
		<br>
		
		<p>Nombre de tickets boissons:</p>
		<p><?php echo($_SESSION['nb_ticket']->get_value());?></p>
		<br>
		
		<p>Adresse email de l'enfant réferent:</p>
		<p><?php echo($_SESSION['email_enf']->get_value());?></p>
		<br>
		<br>
		
		<p>Prix global:</p>
		<p><?php echo($_SESSION['prix']);?></p>

		</article>

		<form action="paiement.php" method="post">
			<div class="btn-group" role="group" id="valider">	
				<label for="payer">Payer</label>
				<a href="paiement.php"><input type="submit" class="btn btn-default" value="payer"></a>
			</div>
	</body>
</html>
