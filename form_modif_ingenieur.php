<?php
require "class/Donnee.php";
require "config.php";
session_start();

if (!isset($_SESSION['modification']))
{
	header('./form_deja_pris.php');
	exit();
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
		<form method="post" action="recap_avant_paiement_ingenieur.php" class="col-md-offset-1 col-md-5">
		<fieldset>
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
      				if($_SESSION['check_conference']->get_value()==null )
      					{ ?>
				      		<div class="checkbox">
				      			<label><input type="checkbox" name="check_conference">Participation à la conférence <span class="label label-primary">+ <?php echo($settings['tarifs']['conf']) ?>€</span></label>
				      		</div>
				      		<br>
				      	<?php }
				}
				else
				{ ?>
					<div class="checkbox">
				      			<label><input type="checkbox" name="check_conference">Participation à la conférence <span class="label label-primary">+ <?php echo($settings['tarifs']['conf']) ?>€</span></label>
				      		</div>
				      		<br>
				<?php } ?>


      		<label for="nb_ticket">combien de tickets boissons voulez vous ? <span class="label label-primary">+ <?php echo($settings['tarifs']['ticket_boisson']) ?>€/ticket</span></label><br />

		       <select name="nb_ticket" id="pays">
		       <?php
		       if (!isset($_SESSION['nb_ticket']))
		       { ?>
		   			 <option value=0>0</option>
		   			 <option value=10>10</option>
		   			 <option value=20>20</option>
		   			 <option value=30>30</option>
		   			 <option value=40>40</option>
		   			 <option value=50>50</option>
		       <?php }
		       else
		       {
		       		if ($_SESSION['nb_ticket']->get_value()=='0')
		       		{ ?>
			       		<option value=0>0</option>
			   			<option value=10>10</option>
			   			<option value=20>20</option>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket']->get_value()=='10')
		       		{ ?>
			       		<option value=10>10</option>
			   			<option value=20>20</option>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket']->get_value()=='20')
		       		{ ?>
			       		<option value=20>20</option>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket']->get_value()=='30')
		       		{ ?>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket']->get_value()=='40')
		       		{ ?>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		else
		       		{ ?>
			   			<option value=50>50</option>
		       		<?php }
		       } ?>
		       </select>
		       <br>
		       <br>
		    </fieldset>
		    <fieldset>
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
		       <?php
		       if (!isset($_SESSION['nb_ticket_inv']))
		       { ?>
		   			 <option value=0>0</option>
		   			 <option value=10>10</option>
		   			 <option value=20>20</option>
		   			 <option value=30>30</option>
		   			 <option value=40>40</option>
		   			 <option value=50>50</option>
		       <?php }
		       else
		       {
		       		if ($_SESSION['nb_ticket_inv']->get_value()=='0')
		       		{ ?>
			       		<option value=0>0</option>
			   			<option value=10>10</option>
			   			<option value=20>20</option>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket_inv']->get_value()=='10')
		       		{ ?>
			       		<option value=10>10</option>
			   			<option value=20>20</option>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket_inv']->get_value()=='20')
		       		{ ?>
			       		<option value=20>20</option>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket_inv']->get_value()=='30')
		       		{ ?>
			   			<option value=30>30</option>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		elseif ($_SESSION['nb_ticket_inv']->get_value()=='40')
		       		{ ?>
			   			<option value=40>40</option>
			   			<option value=50>50</option>
		       		<?php }
		       		else
		       		{ ?>
			   			<option value=50>50</option>
		       		<?php }
		       } ?>
		       </select>

		    <br>
		    <br>
		</fieldset>
		<div class="btn-group" role="group" id="valider">
			<a href="recap_avant_paiement_ingenieur.php"><input type="submit" class="btn btn-default" value="valider"></a>
		</div>
		<br/>
		<br/>
		<br/>
		</form>
	</body>
</html>
	<?php include("inclusion/pied_de_page.php"); ?>