<?php
require "class/Donnee.php";
require "config.php";
include("inclusion/header.php");
?>

<!DOCTYPE html>
<html>
	<body>
		<form method="post" action="gestion_db/enreg_modif_ingenieur.php">
		<fieldset id="valider">
		<legend>Votre Place</legend>

			<?php if (isset($_SESSION['erreur']))
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
				} ?> >
			</div>
			<br>
				
			<div class="input-group" id='telephone'>
		  		<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
		  		<input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2" name="tel"
		  		<?php if (isset($_SESSION['tel']))
				{ ?> 
					value=<?php echo($_SESSION['tel']->get_value());
				}?> >
			</div>
			<br>
      		<?php if (isset($_SESSION['check_conference']))
      			{
      				if($_SESSION['check_conference']->get_value()==null or $_SESSION['check_conference']->get_value()=='0')
      					{ ?>
				      		<div class="checkbox">
				      			<label><input type="checkbox" name="check_conference">Participation à la conférence <span class="label label-primary">+<?php echo($settings['tarifs']['conf']) ?>€</span></label>
				      		</div>
				      		<br>
				      	<?php }

					elseif($_SESSION['check_conference']->get_value()=='on' or $_SESSION['check_conference']->get_value()=='1')
      					{ ?>
      					<div class="checkbox">
				      			<label><input type="checkbox" name="check_conference" checked >Participation à la conférence <span class="label label-primary">+ 3€</span></label>
				      	</div>
				      	<br>

						<?php }
						}
				else
				{ ?>
<<<<<<< HEAD
<<<<<<< HEAD
						<div class="checkbox">
				      			<label><input type="checkbox" name="check_conference">Participation à la conférence <span class="label label-primary">+ 3€</span></label>
				      	</div>
				      	<br>
						<?php } ?>
=======
=======
>>>>>>> origin/master
					<div class="checkbox">
				      			<label><input type="checkbox" name="check_conference">Participation à la conférence <span class="label label-primary">+<?php echo($settings['tarifs']['conf']) ?>€</span></label>
				      		</div>
				      		<br>
				<?php } ?>

>>>>>>> a9bfb200e82749aeb564e6e343f9a1efb89687e3

      		<label for="nb_ticket">combien de tickets boissons voulez vous ? <span class="label label-primary">+<?php echo($settings['tarifs']['ticket_boisson']) ?>€/ticket</span></label><br />

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
		       <br>
		       <br>
		    </fieldset>
		    <fieldset id="valider">
		    <legend>Place de votre invité</legend>
		    	<br>
		       <div class="input-group" id="nom">
	  				<span class="input-group-addon" id="sizing-addon2">Nom</span>
					<input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom_inv"
				<?php if (isset($_SESSION['nom_inv']))
				{?> 
					value=<?php echo($_SESSION['nom_inv']->get_value());
				}?> >
			</div>
			<br>
			<div class="input-group" id='prenom'>
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
		  		<input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2" name="tel_inv"
		  		<?php if (isset($_SESSION['tel_inv']))
				{ ?> 
					value=<?php echo($_SESSION['tel_inv']->get_value());
				}?> >
			</div>
			<br>
		    
		    <label for="nb_ticket_inv">combien de tickets boissons voulez vous ? <span class="label label-primary">+<?php echo($settings['tarifs']['ticket_boisson']) ?>€/ticket</span></label><br />

		       		       <select name="nb_ticket_inv" id="pays">

		           <option value=0 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='0')
      												{?>
      													selected
      												<?php }
      										}?> >0</option>

		           <option value=10 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='10')
      												{?>
      													selected
      												<?php }
      										}?> >10</option>


		           <option value=20 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='20')
      												{?>
      													selected
      												<?php }
      										}?> >20</option>

		           <option value=30 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='30')
      												{?>
      													selected
      												<?php }
      										}?> >30</option>

		           <option value=40 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='40')
      												{?>
      													selected
      												<?php }
      										}?> >40</option>

		           <option value=50 <?php if (isset($_SESSION['nb_ticket_inv']))
      										{
      											if ($_SESSION['nb_ticket_inv']->get_value()=='50')
      												{?>
      													selected
      												<?php }
      										}?> >50</option>

		       </select>

		    <br>
		    <br>
		</fieldset>
		<div class="btn-group" role="group" id="valider">
			<a href=gestion_db/enreg_modif_ingenieur.php"><input type="submit" class="btn btn-default" value="valider"></a>
		</form>
	</body>
	<footer><br></footer>
</html>