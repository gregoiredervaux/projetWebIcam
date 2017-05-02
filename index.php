<?php
require "class/Donnee.php";
session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("inclusion/head.php"); ?>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>
		<header>
			<?php include("inclusion/entete.php"); ?>
		</header>
			<!-- DEBUT CAROUSEL -->
		<div class="container">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			    <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			    <div class="item active">
			      <img src="media/promo.jpg" alt="Promo" style="width:100%;">
			      <div class="carousel-caption">
			        <h3>Le travail d'une promotion</h3>
			        <p>Les 106 élèves de la promotion 119 travail ensemble depuis septembre pour vous offrir le plus beau des Gala</p>
			      </div>
			    </div>

			    <div class="item">
			      <img src="media/icam.jpg" alt="Icam" style="width:100%;">
			      <div class="carousel-caption">
			        <h2>Un évènement au sein même de l'Icam</h2>
			      </div>
			    </div>

			    <div class="item">
			      <img src="media/rendlargent.jpg" alt="Argent" style="width:100%;">
			      <div class="carousel-caption">
			        <h1>#REND L'ARGENT</h1>
			      </div>
			    </div>
			  </div>

			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		<!-- FIN CAROUSEL -->
			<br>
			<div class="row"> <!-- Boutons selections -->
				<nav>
					<div class="col-md-offset-2 col-md-3">
						<form method="post" action="./form_parent.php">
							<div class="btn-group" role="group">
								<input type="hidden" name="statut" value="parent">
								<input type="submit" class="btn btn-primary" value="Je suis un parent d'élève">
							</div>
						</form>
					</div>
					<div class="col-md-3">
						<form method="post" action="./form_ingenieur.php">
							<div class="btn-group" role="group">
								<input type="hidden" name="statut" value="ingenieur">
								<input type="submit" class="btn btn-primary" value="Je suis un ingénieur Icam">
							</div>
						</form>
					</div>

					<div class="col-md-3">
						<form method="post" action="./form_deja_pris.php">
							<div class="btn-group" role="group">
								<input type="hidden" name="statut" value="deja_pris">
								<input type="submit" class="btn btn-primary" value="J'ai déjà pris ma place">
							</div>
						</form>
					</div>
				</nav>
			</div>
			<!-- Fin boutons -->
			<br>
			<div class="row"><h3 class="col-md-12 text-center">Revivez l'annonce du thème</h3></div>

			<section class="row" id="video_annonce">
			 <div class="col-md-12">
			  	<video width=100% height="480" controls>
    				<source src="media/annonce_theme.mp4" type="video/mp4">
				</video>
			  </div>
			</section>
			<br>

			<section class="row" id="theme">
				<div class="col-md-8"><h3>Au Crépuscule d'un règne</h3>
					<div class="row"><p>Ceci est un thème bla bla bla explication GREGOIRE REND L'ARGENT #balec' de ton vélo moi je voulais une switch fheniopmre hiêhguersh hqu relocalhvu revhreyvgw vhnrebergh e gjhr eufhgjbjtrpbjt vdgdsy vjpbkkxndfjvb k,, ^shk jvidfhds dvofdvk hfucosdvh dkhs egfsefi rlvrev rijvr  gjv djvjdhegfhr kerofjru zeyf hre PENSER A CHANGER POLICE ECRITURE ET PEUT ETRE LA COULEUR</p></div>
				</div>
				<div class="col-md-3"><img src="media/pyramide.jpg" alt="logo gala"></div>
			</section>
			<br>
			<section class="row" id="spread">
				<div class="col-md-3"><img src="media/bg.jpg" alt="logo spread"></div>
				<div class="col-md-8"><h3>Conférence Spread</h3>
					<div class="row"><p>conférence spread qui n'a pas de putin de logo trouvable ni d'image qui rentre ici donc en attendant voici une photo de notre bien aimé BG, de plus bjiverh gbceusichrg gyfuirzecg ghfovcduygv regherivgd gfoergtfvyred vbo gfyvrd vgrey vregyrfgvhufdgv ghukfygsdrvdhvhd hdildfuh dihdfh kdfhg dfhkg dfh gh ufhredf rhhr fjzesgfzseh fkesgfsekjgvhrdh seh rgvrdyf kghi erh herggi rh dgrig rd hjg irdg dh</p></div>
				</div>
			</section>
			<br>
			<br>
			<div class="row"><h2 class="col-md-12 text-center">Accès</h2></div>
			<section class="row" id="acces">
					<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="70%" height="440px" src="https://maps.google.com/maps?hl=en&q=1 rue lestiboudois lille&ie=UTF8&t=p&z=16&iwloc=B&output=embed" class="col-md-12"></iframe>
					<!-- balise originale
					<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="60%" height="440px" src="https://maps.google.com/maps?hl=en&q=1 rue lestiboudois lille&ie=UTF8&t=p&z=16&iwloc=B&output=embed"><div><small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small></div><div><small><a href="http://www.ultimatewebtraffic.com">Ultimate Web Traffic</a></small></div></iframe>
					-->
				</div>
			</section>
		</div> <!-- fin div container -->
		<br>
		<br>
		<footer>
			<?php include("inclusion/pied_de_page.php") ?>
		</footer>
	</body>
</html>