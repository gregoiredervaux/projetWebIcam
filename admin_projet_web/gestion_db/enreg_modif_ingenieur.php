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

if(isset($_SESSION['statut_inv']))
{
	if($_SESSION['statut_inv']=='empty' && isset($_SESSION['nom_inv']))
	{
		$_SESSION['statut_inv']='new';
	}
}

// echo("session av");
// var_dump($_SESSION);

require "./verif_modif_donnee_formulaire.php";

// echo("session av");
// var_dump($_SESSION);
// die();

//initialisation des variables
$id=$_SESSION['id']->get_value();
$nom=$_SESSION['nom']->get_value();
$prenom=$_SESSION['prenom']->get_value();
$email=$_SESSION['email']->get_value();
$tel=intval($_SESSION['tel']->get_value());
$nb_ticket=$_SESSION['nb_ticket']->get_value();
if (isset($_SESSION['check_conference']))
{
	if($_SESSION['check_conference']->get_value()=='on')
	{
		$conf=1;
	}
}
$update_inge=$bd->prepare('UPDATE '.$settings['confSQL']['bd_invite'].' 
	SET 
		nom= :nom, 
		prenom= :prenom, 
		email= :email, 
		telephone= :tel, 
		ticket_boisson= :nb_ticket, 
		diner= :diner, 
		conference= :conf 
		WHERE id= :id');

$update_inge->bindParam('nom', $nom, PDO::PARAM_STR);
$update_inge->bindParam('prenom', $prenom, PDO::PARAM_STR);
$update_inge->bindParam('email', $email, PDO::PARAM_STR);
$update_inge->bindParam('tel', $tel, PDO::PARAM_INT);
$update_inge->bindParam('nb_ticket', $nb_ticket, PDO::PARAM_INT);
$update_inge->bindParam('diner', $diner, PDO::PARAM_STR);
$update_inge->bindParam('conf', $conf, PDO::PARAM_STR);
$update_inge->bindParam('id', $id, PDO::PARAM_INT);

$update_inge->execute();

//sauvegarder l'invite
if($_SESSION['statut_inv']=='new')
{
	$nom_inv=$_SESSION['nom_inv']->get_value();
	$prenom_inv=$_SESSION['prenom_inv']->get_value();
	$nb_ticket_inv=$_SESSION['nb_ticket_inv']->get_value();
	$tel_inv=$_SESSION['tel_inv']->get_value();

	$set_inv=$bd->prepare('INSERT INTO '.$settings['confSQL']['bd_invite'].'
		(id,nom,prenom,email,telephone,ticket_boisson,promo,date_inscription,diner,conference,psw) 
		VALUES(DEFAULT,:nom,:prenom,null,:tel,:nb_ticket,null,DEFAULT,0,:conf,null)');
	$set_inv->bindParam('nom', $nom_inv,PDO::PARAM_STR);
	$set_inv->bindParam('prenom', $prenom_inv,PDO::PARAM_STR);
	$set_inv->bindParam('tel', $tel,PDO::PARAM_INT);
	$set_inv->bindParam('nb_ticket', $nb_ticket,PDO::PARAM_STR);
	$set_inv->bindParam('conf', $conf,PDO::PARAM_STR);

	$set_inv->execute();

	$id_inv=$bd->lastInsertId();

	$set_lien=$bd->prepare('INSERT INTO '.$settings['confSQL']['bd_inge_has_guest'].'(id_inge,id_invite)
		VALUES( :id_inge , :id_inv )');

	$set_lien->bindParam('id_inge', $id, PDO::PARAM_INT);
	$set_lien->bindParam('id_inv', $id_inv, PDO::PARAM_INT);

	$set_lien->execute();
}
elseif($_SESSION['statut_inv']=='old')
{
	
	$recup_id_inv=$bd->prepare('SELECT id_invite FROM '.$settings['confSQL']['bd_inge_has_guest'].' WHERE id_inge= :id');
	$recup_id_inv->bindParam('id', $id,PDO::PARAM_STR);
	$recup_id_inv->execute();
	$donnee_id_inv=$recup_id_inv->fetch();
	$id_inv=$donnee_id_inv['id_invite'];


	$nom_inv=$_SESSION['nom_inv']->get_value();
	$prenom_inv=$_SESSION['prenom_inv']->get_value();
	$nb_ticket_inv=$_SESSION['nb_ticket_inv']->get_value();
	$tel_inv=$_SESSION['tel_inv']->get_value();

	$set_inv=$bd->prepare('UPDATE '.$settings['confSQL']['bd_invite'].'
		SET 
		nom= :nom, 
		prenom= :prenom, 
		telephone= :tel, 
		ticket_boisson= :nb_ticket, 
		conference= :conf 
		WHERE id= :id');

	$set_inv->bindParam('nom', $nom_inv,PDO::PARAM_STR);
	$set_inv->bindParam('prenom', $prenom_inv,PDO::PARAM_STR);
	$set_inv->bindParam('tel', $tel_inv,PDO::PARAM_INT);
	$set_inv->bindParam('nb_ticket', $nb_ticket_inv,PDO::PARAM_STR);
	$set_inv->bindParam('conf', $conf,PDO::PARAM_STR);
	$set_inv->bindParam('id',$id_inv,PDO::PARAM_STR);

	$set_inv->execute();
}
$_SESSION['inv']=true;
echo("yep");
header("Location: ../recap_post_paiement_ingenieur");


