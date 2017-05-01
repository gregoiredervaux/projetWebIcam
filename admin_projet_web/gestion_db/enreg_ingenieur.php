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
$promo=$_SESSION['promo']->get_value();
$nom=$_SESSION['nom']->get_value();
$prenom=$_SESSION['prenom']->get_value();
$email_inge=$_SESSION['email']->get_value();
$tel_inge=$_SESSION['tel']->get_value();
$nb_ticket=$_SESSION['nb_ticket']->get_value();
$nom_inv=$_SESSION['nom_inv']->get_value();
$prenom_inv=$_SESSION['prenom_inv']->get_value();
$tel_inv=$_SESSION['tel_inv']->get_value();
$nb_ticket_inv=$_SESSION['nb_ticket_inv']->get_value();
$conf_value=0;

//on genere automatiquement un mot de passe


$psw=chaine_aleatoire(20);

$psw_salted=$settings['security']['prefix_salt'].$psw.$settings['security']['suffix_salt'];

$psw_hash=password_hash($psw_salted,PASSWORD_DEFAULT,array('salt' => $settings['security']['default_salt']));

//ici, on peut ajouter le parents sans craindre de conflits.
$ajout_inge=$bd->prepare('INSERT INTO '.$settings['confSQL']['bd_invite'].'(id,nom,prenom,email,telephone,ticket_boisson,promo,date_inscription,diner,conference,psw) 
	VALUES(DEFAULT,:nom,:prenom,:email,:tel,:nb_ticket,:promo,DEFAULT,0,:conf,:psw)');


$ajout_inge->bindParam('nom', $nom, PDO::PARAM_STR);
$ajout_inge->bindParam('prenom',$prenom , PDO::PARAM_STR);
$ajout_inge->bindParam('email',$email_inge, PDO::PARAM_STR);
$ajout_inge->bindParam('tel', $tel_inge, PDO::PARAM_INT);
$ajout_inge->bindParam('nb_ticket', $nb_ticket , PDO::PARAM_STR);
$ajout_inge->bindParam('promo', $promo , PDO::PARAM_INT);

if(isset($_SESSION['check_conference']))
{
	if ($_SESSION['check_conference']->get_value()=='on')
	{
		$conf_value=1;
	}
}
$ajout_inge->bindParam('conf', $conf_value, PDO::PARAM_INT);

$ajout_inge->bindParam('psw', $psw_hash, PDO::PARAM_STR);

$ajout_inge->execute();
// on recupère l'id de la dernière requete executee via PDO
$id_inge=$bd->lastInsertId();

if(!isset($_SESSION['pas_inv']))
{
$ajout_inv=$bd->prepare('INSERT INTO '.$settings['confSQL']['bd_invite'].'(id,nom,prenom,email,telephone,ticket_boisson,promo,date_inscription,diner,conference,psw) 
	VALUES(DEFAULT,:nom,:prenom,null,:tel,:nb_ticket,null,DEFAULT,0,:conf,null)');


$ajout_inv->bindParam('nom', $nom_inv, PDO::PARAM_STR);
$ajout_inv->bindParam('prenom',$prenom_inv , PDO::PARAM_STR);
$ajout_inv->bindParam('tel', $tel_inv, PDO::PARAM_INT);
$ajout_inv->bindParam('nb_ticket', $nb_ticket_inv , PDO::PARAM_STR);
if(isset($_SESSION['check_conference']))
{
	if ($_SESSION['check_conference']->get_value()=='on')
	{
		$conf_value=1;
	}
}
$ajout_inv->bindParam('conf', $conf_value, PDO::PARAM_INT);

$ajout_inv->execute();


// on recupère l'id de la dernière requete executee via PDO
$id_inv=$bd->lastInsertId();

//on fait met a jour la relation icam/parent
$set_lien=$bd->prepare('INSERT INTO '.$settings['confSQL']['bd_inge_has_guest'].'(id_inge,id_invite)
		VALUES( :id_inge , :id_inv )');

$set_lien->bindParam('id_inge', $id_inge, PDO::PARAM_INT);
$set_lien->bindParam('id_inv', $id_inv, PDO::PARAM_INT);

$set_lien->execute();
}

$_SESSION['enregistrement']="fait";
$_SESSION['id']=$id_inge;
$_SESSION['psw']=$psw;
header("Location: ../recap_post_paiement_ingenieur");
?>