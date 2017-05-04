<?php
require "class/Donnee.php";
require "config.php";
include("inclusion/header.php");

if (!isset($_SESSION['statut']))
{
	$_SESSION=array('email_admin' => $_SESSION['email_admin']);
	$_SESSION['statut']=new Donnee ('ingenieur','statut');
}
elseif ($_SESSION['statut']->get_value()!='ingenieur')
{
	//si la session est autre que ce que dit le POST, c'est qu'il a déjà visité un autre formulaire, donc on reinitialise la session
	$_SESSION=array('email_admin' => $_SESSION['email_admin']);
	$_SESSION['statut']=new Donnee ('ingenieur','statut');
}
?>

<!DOCTYPE html>
<html>
	<body>
		<form method="post" action="gestion_db/verif_enreg_parent.php">
		<fieldset id="valider">
		<legend>Votre Place</legend>

			<?php if (isset($_SESSION['erreur']))
					{
						
						if(isset($_SESSION['erreur']['bool_email_invalide']))
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> l'adresse email de l'enfant entrée ne fait réference à aucune adresse email Icam connue</p>
							</div>
						<?php }
						elseif(isset($_SESSION['erreur']['bool_nb_place_depasse']))
						{?>
							<div class="alert alert-danger" role="alert">
								<p> <strong>Attention !</strong> Votre enfant à déjà invité deux personnes ! <br> si il s'agit d'une usurpation, veuiller contacter l'adresse email si-contre:<br> <?php echo($settings['emailContactGala']); ?></p>
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
		  		<span class="input-group-addon" id="sizing-addon2">email personnel</span>
		  		<input type="text" class="form-control" placeholder="Adresse email" aria-describedby="sizing-addon2" name="email"
		  		<?php if (isset($_SESSION['email']))
				{?> 
					value=<?php echo($_SESSION['email']->get_value());
				}?> >
			</div>
			<br>
				<div class="input-group" id="mail">
		  			<span class="input-group-addon" id="sizing-addon2">email de l'enfant</span>
		  			<input type="text" class="form-control" placeholder="Adresse email Icam de l'enfant référent" aria-describedby="sizing-addon2" name="email_enf"
		  			<?php if (isset($_SESSION['email_enf']))
				{?> 
					value=<?php echo($_SESSION['email_enf']->get_value());
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
      			<label><input type="checkbox" name="check_diner"
      			<?php if (isset($_SESSION['check_diner']))
      			{?>
      				checked
      			<?php } ?> >Participation au diner <span class="label label-primary">+ <?php echo($settings['tarifs']['diner']) ?>€</span></label>
      		</div>
      		<br>
      		<div class="checkbox">
      			<label><input type="checkbox" name="check_conference"
      			.<?php if (isset($_SESSION['check_conference']))
      			{?>
      				checked
      			<?php } ?> >Participation à la conférence <span class="label label-primary">+ <?php echo($settings['tarifs']['conf']) ?>€</span></label>
      		</div>
      		<br>
      		<div>
      		<label for="nb_ticket">combien de tickets boissons voulez vous ? <span class="label label-primary">+ <?php echo($settings['tarifs']['ticket_boisson']) ?>€/ticket</span></label><br />

		       <select name="nb_ticket" id="pays">

		           <option value=0 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='0')
      												{?>
      													selected
      												<?php }
      										}?> >0</option>

		           <option value=10 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='10')
      												{?>
      													selected
      												<?php }
      										}?> >10</option>

		           <option value=20 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='20')
      												{?>
      													selected
      												<?php }
      										}?> >20</option>

		           <option value=30 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='30')
      												{?>
      													selected
      												<?php }
      										}?> >30</option>

		           <option value=40 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='40')
      												{?>
      													selected
      												<?php }
      										}?> >40</option>

		           <option value=50 <?php if (isset($_SESSION['nb_ticket']))
      										{
      											if ($_SESSION['nb_ticket']->get_value()=='50')
      												{?>
      													selected
      												<?php }
      										}?> >50</option>

		       </select>
		    </div>
		    <br>
		</fieldset>
		<div class="btn-group" role="group" id="valider">
			<a href="gestion_db/verif_enreg_parent.php"><input type="submit" class="btn btn-default" value="valider"></a>
		</form>
	</body>
</html>