<?php
require "../class/Donnee.php";
require "../class/Securise.php";
include ('../config.php');
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
$nom=$_SESSION['nom']->get_value();
$prenom=$_SESSION['prenom']->get_value();
$email_parent=$_SESSION['email']->get_value();
$email_enf=$_SESSION['email_enf']->get_value();
$tel_parent=$_SESSION['tel']->get_value();
$nb_ticket=$_SESSION['nb_ticket']->get_value();
$diner_value=null;


//ici, on peut ajouter le parents sans craindre de conflits.
$ajout_parent=$bd->prepare('INSERT INTO '.$settings['confSQL']['bd_invite'].'(id,nom,prenom,email,telephone,ticket_boisson,promo,date_inscription,diner,conference) 
	VALUES(DEFAULT,:nom,:prenom,:email,:tel,:nb_ticket,\'parent\',DEFAULT,:diner,:conf)');


$ajout_parent->bindParam('nom', $nom, PDO::PARAM_STR);
$ajout_parent->bindParam('prenom',$prenom , PDO::PARAM_STR);
$ajout_parent->bindParam('email',$email_parent , PDO::PARAM_STR);
$email_enf=$_SESSION['email_enf']->get_value();
$ajout_parent->bindParam('tel', $tel_parent, PDO::PARAM_INT);
$ajout_parent->bindParam('nb_ticket', $nb_ticket , PDO::PARAM_STR);
if ($_SESSION['check_diner']->get_value()=='on')
{
	$diner_value=1;
}
$ajout_parent->bindParam('diner', $diner_value, PDO::PARAM_INT);

$conf_value=null;
if ($_SESSION['check_conference']->get_value()=='on')
{
	$conf_value=1;
}
$ajout_parent->bindParam('conf', $conf_value, PDO::PARAM_INT);

$ajout_parent->execute();
// on recupère l'id de la dernière requete executee via PDO
$id_parent=$bd->lastInsertId();
echo("id_parent par le last id etc...");
var_dump($id_parent);

//on fait met a jour la relation icam/parent

$recup_lien=$bd->prepare('SELECT id,id_parent1 FROM '.$settings['confSQL']['bd_icam_has_gest'].' AS bd_lien
	INNER JOIN '.$settings['confSQL']['bd_etudiant_icam'].' AS bd_icam ON bd_icam.id=bd_lien.id_icam
	WHERE email= :email');

$recup_lien->bindParam('email', $email_enf, PDO::PARAM_STR);
$recup_lien->execute();

$recup_lien_value=$recup_lien->fetch();

echo("recup_lien_value");
var_dump($recup_lien_value);

if (!isset($recup_lien_value['id']))
{
	
	$recup_id=$bd->prepare('SELECT id FROM '.$settings['confSQL']['bd_etudiant_icam'].' WHERE email= :email');
	$recup_id->bindParam('email', $email_enf, PDO::PARAM_STR);
	$recup_id->execute();

	$id=$recup_id->fetch();

	echo("info id");
	var_dump($id);

	echo("info id_parent");
	var_dump($id_parent);
	//on a toutes les infos pour mettre a jour le lien

	$set_lien=$bd->prepare('INSERT INTO '.$settings['confSQL']['bd_icam_has_gest'].'(id_icam,id_parent1)
		VALUES( :id , :id_parent1 )');

	$set_lien->bindParam('id', $id['id'], PDO::PARAM_INT);
	$set_lien->bindParam('id_parent1', $id_parent, PDO::PARAM_INT);

	$set_lien->execute();
}
else
{
	$id=$recup_lien_value['id'];
	echo("info id");
	var_dump($id);

	echo("info id_parent");
	var_dump($id_parent);
	//on a toutes les infos pour mettre a jour le lien

	$set_lien=$bd->prepare('UPDATE '.$settings['confSQL']['bd_icam_has_gest'].' SET id_parent2= :id_parent2');
	$set_lien->bindParam('id_parent2', $id_parent, PDO::PARAM_INT);

	$set_lien->execute();
}
$_SESSION['enregistrement']="fait";
header("Location: recap_post_paiement_parent");
?>