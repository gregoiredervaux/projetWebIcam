<?php
//adresse mail cible

$mail=$_SESSION['email']->get_value();
$nom=$_SESSION['nom']->get_value();


if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}

$boundary = "-----=".md5(rand());

$header = "From: \"gregemail\"<gregemail2.0@gmail>".$passage_ligne;
$header.= "Reply-to: \"guigui\" <".$settings['emailContactGala'].">".$passage_ligne; 
$header.= "MIME-Version: 1.0".$passage_ligne; 
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

$message= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne."--".$boundary.$passage_ligne;
$message.= "<html>
					<head>
					</head>

					<body>
						<b>Bonjour !</b>
						<br>
						<br>
						Merci d'avoir pris votre place pour le gala icam.
						<br>
						votre identifiant est:
						<br>
						".$mail."
						<br>
						votre mot de passe est le suivant:
						".$_SESSION['psw']."
						<br>
						<br>
						veuiller trouver ci-joint votre place au format PDF.
						<br>
						<br>
						Salutations, en espérant vous retrouver en forme le 28 janvier !
						<br>
						La promotion 119.
					</body>
				</html>";
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

$sujet="Gala des Icams";

mail($mail,$sujet,$message,$header);