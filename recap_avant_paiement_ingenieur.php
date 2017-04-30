<?php
require "/class/Donnee.php";
require "/class/Securise.php";
include ('/config.php');
session_start();

if(!isset($_SESSION['verif']))
{
	// header("Location: mauvais_chemin.php");
}
elseif($_SESSION['verif']==false)
{
	// header("Location: mauvais_chemin.php");
}
<<<<<<< HEAD
=======
var_dump($_SESSION);
>>>>>>> origin/master

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
			
<<<<<<< HEAD
			<p> <Strong>Récaputilatif:</Strong></p>
			<br>
			
			<p> Noms:</p>
			<p><?php echo($_SESSION['nom']->get_value());?></p>
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
					
			<p>Participation à la conférence:</p>
			<?php if(isset($_SESSION['check_conference']))
						{
							if($_SESSION['check_conference']=='on')
							{ ?>
								<p>oui</p>
							<?php }
						}
						else
							{?>
								<p>non</p>
							<?php } ?>
			<br>

			<p>Nombre de tickets boisson:</p>
			<p><?php echo($_SESSION['nb_ticket']->get_value());?></p>
			<br>

			<p>Noms de l'invité:</p>
			<p><?php echo($_SESSION['nom_inv']->get_value());?></p>
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

		<form action="paiement.php" method="post">
			<div class="btn-group" role="group" id="valider">	
				<a href="paiement.php"><input type="submit" class="btn btn-default" value="payer"></a>
			</div>
		</form>
		<div class="btn-group" role="group" aria-label="...">
  			<a href="form_ingenieur.php"><button type="button" class="btn btn-default">retour au formulaire</button></a>
  		</div>
=======
			

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

				<p><strong>Noms de l'invité:</strong>
				<?php echo($_SESSION['nom_inv']->get_value());?></p>
				
				<p><strong>Prenom de l'invité:</strong>
				<?php echo($_SESSION['prenom_inv']->get_value());?></p>

				<p><strong>Telephone de l'invité:</strong>
				<?php echo($_SESSION['tel_inv']->get_value());?></p>

				<p><strong>Nombre de tickets boisson de l'invité:</strong>
				<?php echo($_SESSION['nb_ticket_inv']->get_value());?></p>
				
				<p><strong>Prix global:</strong>
				<?php echo($_SESSION['prix']);?></p>
				<br>

				</div>
				<div class="col-md-offset-1">
					<div class="btn-group" role="group" id="valider">	
						<a href="paiement.php"><button type="button" class="btn btn-default">Payer</button></a>
  						<a href="form_ingenieur.php"><button type="button" class="btn btn-default">Retour au formulaire</button></a>
  					</div>
				</div>

		</article>

			
>>>>>>> origin/master
	</body>
</html>