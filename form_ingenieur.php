<?php
require "class/Donnee.php";
require "config.php";
session_start();

if (isset($_POST['statut']) && $_POST['statut']=='ingenieur')
{
	if (isset($_SESSION['statut']))
	{
		if ($_SESSION['statut']->get_value()!=$_POST['statut'])
		{
			//si la session est autre que ce que dit le POST, c'est qu'il à déjà visiter un autre formulaire, donc on reinitilaise la session
			$_SESSION=array();
		}
	}
	$_SESSION['statut']=new Donnee ('ingenieur','statut');
}
else
{
	header('./index.php');
}

if (isset($_SESSION))
{
	var_dump($_SESSION);
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
		<form method="post" action="gestion_db/verif_enreg_ingenieur.php">
			<fieldset>
			<legend>Votre Place</legend>

				<?php if (isset($_SESSION['erreur']))
					{
						if(isset($_SESSION['erreur']['bool_nb_place_depasse']))
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> nombre de place maximal atteint ! vous ne pouvez plus prendre de place...</p>
							</div>
						<?php }
						elseif(isset($_SESSION['erreur']['bool_doublons']))
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> vous êtes déjà enregistré(e) ! <br> si il s'agit d'une usurpation, veuiller contacter l'adresse email si-contre:<br> <?php echo($settings['emailContactGala']); ?></p> 
							</div>
						<?php }
						else
						{
							foreach ($_SESSION['erreur'] as $key => $value)
							{
								if ($_SESSION['erreur'][$key]->get_value()=='')
									{?>
										<div class="alert alert-danger" role="alert">
											<p> <strong>Attention !</strong> un champs <?php echo($_SESSION['erreur'][$key]->get_type())?> n'est pas remplis</p>
										</div>
									<?php }
								else
									{?>
										<div class="alert alert-danger" role="alert">
											<p> <strong>Attention !</strong> <?php echo($_SESSION['erreur'][$key]->get_value()) ?> n'est pas un <?php echo($_SESSION['erreur'][$key]->get_type())?> valide</p>
										</div>
									<?php }
							}
						}
					} ?>

				<div class="input-group" id="nom">
		  		<span class="input-group-addon" id="sizing-addon2">promotion</span>
				<input type="text" class="form-control" aria-describedby="sizing-addon2" name="promo" 
				<?php if (isset($_SESSION['promo']))
				{?> 
					value=<?php echo($_SESSION['promo']->get_value());
				}?> >
				</div>
				<br>
				<div class="input-group" id="nom">
		  		<span class="input-group-addon" id="sizing-addon2">Nom</span>
				<input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom"
				<?php if (isset($_SESSION['nom']))
				{?> 
					value=<?php echo($_SESSION['nom']->get_value());
				}?> >
				</div>
				<br>
				<div class="input-group" id='prenom'>
			  		<span class="input-group-addon" id="sizing-addon2">Prénom</span>
			  		<input type="text" class="form-control" aria-describedby="sizing-addon2" name="prenom"
			  		<?php if (isset($_SESSION['prenom']))
				{?> 
					value=<?php echo($_SESSION['prenom']->get_value());
				}?> >
				</div>
				<br>
				<div class="input-group" id="mail">
			  		<span class="input-group-addon" id="sizing-addon2">@</span>
			  		<input type="text" class="form-control" placeholder="email.personnel@exple.fr" aria-describedby="sizing-addon2" name="email"
			  		<?php if (isset($_SESSION['email']))
				{?> 
					value=<?php echo($_SESSION['email']->get_value());
				}?> >
				</div>
				<br>
				<div class="input-group" id='telephone'>
			  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
			  		<input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2" name="tel"
			  		<?php if (isset($_SESSION['tel']))
				{?> 
					value=<?php echo($_SESSION['tel']->get_value());
				}?> >
				</div>
				<br>
				<div class="checkbox">
      				<label><input type="checkbox" name="check_conference"
      			.<?php if (isset($_SESSION['check_conference']))
      				{?>
      					checked
<<<<<<< HEAD
      				<?php } ?> >Participation à la conférence</label>
=======
      				<?php } ?> >Participation à la conférence <span class="label label-primary">+ 3€</span></label>
>>>>>>> origin/master
      			</div>
      			<br>
				<div>
      			<label for="nb_ticket">combien de tickets boissons voulez vous ? <span class="label label-primary">+ 1€/ticket</span></label><br />
		       <select name="nb_ticket" id="pays">

		           <option value=0 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='0')
      												{?>
      													selected
      												<?php }
      										}?> >0</option>

		           <option value=5 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='5')
      												{?>
      													selected
      												<?php }
      										}?> >5</option>

		           <option value=10 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='10')
      												{?>
      													selected
      												<?php }
      										}?> >10</option>

		           <option value=15 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='15')
      												{?>
      													selected
      												<?php }
      										}?> >15</option>

		           <option value=20 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='20')
      												{?>
      													selected
      												<?php }
      										}?> >20</option>

		           <option value=25 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='25')
      												{?>
      													selected
      												<?php }
      										}?> >25</option>

		           <option value=30 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='30')
      												{?>
      													selected
      												<?php }
      										}?> >30</option>

		           <option value=35 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='35')
      												{?>
      													selected
      												<?php }
      										}?> >35</option>

		           <option value=40 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='40')
      												{?>
      													selected
      												<?php }
      										}?> >40</option>

		           <option value=45 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='45')
      												{?>
      													selected
      												<?php }
      										}?> >45</option>

		           <option value=50 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='50')
      												{?>
      													selected
      												<?php }
      										}?> >50</option>

		       </select>
		    <br>
		    <br>
		    </div>
			</fieldset>

			<fieldset>
			<legend>Place invité</legend>
				<div class="input-group" id="nomInvit">
		  		<span class="input-group-addon" id="sizing-addon2">Nom</span>
				<input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom_inv"
				<?php if (isset($_SESSION['nom_inv']))
				{?> 
					value=<?php echo($_SESSION['nom_inv']->get_value());
				}?> >
				</div>
				<br>
				<div class="input-group" id='prenomInvit'>
			  		<span class="input-group-addon" id="sizing-addon2">Prénom</span>
			  		<input type="text" class="form-control" aria-describedby="sizing-addon2" name="prenom_inv"
			  		<?php if (isset($_SESSION['prenom_inv']))
				{?> 
					value=<?php echo($_SESSION['prenom_inv']->get_value());
				}?> >
				</div>
				<br>
				<div class="input-group" id='telephone'>
			  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
			  		<input type="text" class="form-control" placeholder="Telephone invité" aria-describedby="sizing-addon2" name="tel_inv"
			  		<?php if (isset($_SESSION['tel_inv']))
				{?> 
					value=<?php echo($_SESSION['tel_inv']->get_value());
				}?> >
				</div>
				<br>
				<div>
      		<label for="nb_ticket">combien de tickets boissons voulez vous pour votre invité(e) ? <span class="label label-primary">+ 1€/ticket</span></label><br />

		       <select name="nb_ticket_inv" id="pays">

		           <option value=0 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='0')
      												{?>
      													selected
      												<?php }
      										}?> >0</option>

		           <option value=5 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='5')
      												{?>
      													selected
      												<?php }
      										}?> >5</option>

		           <option value=10 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='10')
      												{?>
      													selected
      												<?php }
      										}?> >10</option>

		           <option value=15 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='15')
      												{?>
      													selected
      												<?php }
      										}?> >15</option>

		           <option value=20 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='20')
      												{?>
      													selected
      												<?php }
      										}?> >20</option>

		           <option value=25 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='25')
      												{?>
      													selected
      												<?php }
      										}?> >25</option>

		           <option value=30 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='30')
      												{?>
      													selected
      												<?php }
      										}?> >30</option>

		           <option value=35 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='35')
      												{?>
      													selected
      												<?php }
      										}?> >35</option>

		           <option value=40 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='40')
      												{?>
      													selected
      												<?php }
      										}?> >40</option>

		           <option value=45 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='45')
      												{?>
      													selected
      												<?php }
      										}?> >45</option>

		           <option value=50 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='50')
      												{?>
      													selected
      												<?php }
      										}?> >50</option>

		       </select>
		    </div>
		    <br>
			</fieldset>
			<div class="btn-group" role="group" id="valider">
				<a href="gestion_db/verif_enreg_ingenieur.php"><input type="submit" class="btn btn-default" value="valider"></a>
			</div>
		</form>
	</body>
</html>