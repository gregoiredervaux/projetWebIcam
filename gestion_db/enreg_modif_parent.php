<?php
require "../class/Donnee.php";
require "../class/Securise.php";
require "../config.php";
require "../random_psw.php";
session_start();

try
{
	$bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
	die('erreur:'.$e->getMessage());
}

//initialisation des variables
$id=$_SESSION['id']->get_value();
$nom=$_SESSION['nom']->get_value();
$prenom=$_SESSION['prenom']->get_value();
$email=$_SESSION['email']->get_value();
$tel=intval($_SESSION['tel']->get_value());
$nb_ticket=$_SESSION['nb_ticket']->get_value();
if (isset($_SESSION['check_diner']))
{
	if($_SESSION['check_diner']->get_value()=='on')
	{
		$diner=1;
	}
}
if (isset($_SESSION['check_conference']))
{
	if($_SESSION['check_conference']->get_value()=='on')
	{
		$conf=1;
	}
}

$update=$bd->prepare('UPDATE '.$settings['confSQL']['bd_invite'].' SET 
		nom= :nom, 
		prenom= :prenom, 
		email= :email, 
		telephone= :tel, 
		ticket_boisson= :nb_ticket, 
		diner= :diner, 
		conference= :conf 
		WHERE id= :id');

$update->bindParam('nom', $nom, PDO::PARAM_STR);
$update->bindParam('prenom', $prenom, PDO::PARAM_STR);
$update->bindParam('email', $email, PDO::PARAM_STR);
$update->bindParam('tel', $tel, PDO::PARAM_INT);
$update->bindParam('nb_ticket', $nb_ticket, PDO::PARAM_INT);
$update->bindParam('diner', $diner, PDO::PARAM_STR);
$update->bindParam('conf', $conf, PDO::PARAM_STR);
$update->bindParam('id', $id, PDO::PARAM_INT);

$update->execute();

header("Location: ../recap_post_paiement_parent");
exit();


