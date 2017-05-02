<?php
require "../class/Donnee.php";
require "../class/Securise.php";
include ('../config.php');
session_start();

//initialisation de la connection dans l'objet PDO

try
{
	$bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
	die('erreur:'.$e->getMessage());
}

//verifie si les données rentrées correspondent aux données demandées
include "verif_donnee_formulaire.php";

unset($_SESSION['erreur']);

if (!empty($dico_erreur))
{
	$_SESSION['erreur']=$dico_erreur;
	header('Location: ../form_'.($_SESSION['statut']->get_value()));
	exit();
}


//contre faille XSS sur le dossiers settings qui va venir du serveur donc sujet a modification.
foreach ($settings['confSQL'] as $key => $value) {
	$settings['confSQL'][$key]=Securise::html($value);
}



//initialisation des variables
$nom=$_SESSION['nom']->get_value();
$prenom=$_SESSION['prenom']->get_value();
$email_parent=$_SESSION['email']->get_value();
$email_enf=$_SESSION['email_enf']->get_value();
$tel_parent=$_SESSION['tel']->get_value();
$nb_ticket=$_SESSION['nb_ticket']->get_value();


//on prépare la requette sql pour déterminer si l'adresse mail de l'enfant est valide
$valid_email=$bd->prepare('SELECT COUNT(*) FROM '.$settings['confSQL']['bd_etudiant_icam'].' WHERE email= :email');

// on inclue l'email saisi dans la requettes sql

$valid_email->bindParam('email', $email_enf, PDO::PARAM_STR);
$valid_email->execute();

$rep_valid_email= $valid_email->fetch();
if ($rep_valid_email['COUNT(*)']=='0')
{
	$_SESSION['erreur']['bool_email_invalide']=new Donnee (true,'bool_email_invalide');
	header('Location: ../form_'.($_SESSION['statut']->get_value()));
}
else
{
	//cas ou l'email est modifié par l'utilisateur
	unset($_SESSION['erreur']['bool_email_invalide']);
}


//on prepare une requette pour vérifier qu'il y a bien une place de libre avec cet enfant !
$bd_etudiant_icam=$settings['confSQL']['bd_etudiant_icam'];
$bd_icam_has_guest=$settings['confSQL']['bd_icam_has_guest'];

$valid_nb_place=$bd->prepare ('SELECT id,id_parent1,id_parent2 FROM '.$bd_etudiant_icam.' 
	INNER JOIN '.$bd_icam_has_guest.' ON '.$bd_etudiant_icam.'.id='.$bd_icam_has_guest.'.id_icam 
	WHERE email= :email');

$valid_nb_place->bindParam('email', $email_enf, PDO::PARAM_STR);
$valid_nb_place->execute();

//on recupere les données en sortie de requette
$rep_valid_nb_place=$valid_nb_place->fetch();
if (isset($rep_valid_nb_place['id_parent2']))
{
	$_SESSION['erreur']['bool_nb_place_depasse']=new Donnee (true,'bool_nb_place_depasse');
	header('Location: ../form_'.($_SESSION['statut']->get_value()));
}
else
{
	//cas ou l'email est modifié par l'utilisateur
	unset($_SESSION['erreur']['bool_nb_place_depasse']);
}

//on prepare une requette pour vérifier que la personne n'est pas enregistrée deux fois

$bd_invite=$settings['confSQL']['bd_invite'];
$verif_info_double=$bd->prepare('SELECT count(*) FROM '.$bd_invite.' 
	WHERE nom REGEXP :nom AND prenom REGEXP :prenom AND email = :email');

$nom_reg='~*'.$nom;
$verif_info_double->bindParam('nom', $nom_reg, PDO::PARAM_STR);

$prenom_reg='~*'.$prenom;
$verif_info_double->bindParam('prenom', $prenom_reg, PDO::PARAM_STR);

$verif_info_double->bindParam('email', $email_parent, PDO::PARAM_STR);

$verif_info_double->execute();

$rep_verif_info_double=$verif_info_double->fetch();

if($rep_verif_info_double['count(*)']!='0')
{
	$_SESSION['erreur']['bool_doublons']=new Donnee (true,'bool_doublons');
	header('Location: ../form_'.($_SESSION['statut']->get_value()));
	exit();
}
else
{
	unset($_SESSION['erreur']['bool_doublons']);
}

$_SESSION['prix']=$settings['tarifs']['place'];
if(isset($_SESSION['check_diner']))
{
	if($_SESSION['check_diner']->get_value()=='on')
	{
		$_SESSION['prix']=$_SESSION['prix']+$settings['tarifs']['diner'];
	}
}
elseif(isset($_SESSION['check_conference']))
{
	if($_SESSION['check_conference']->get_value()=='on')
	{
		$_SESSION['prix']=$_SESSION['prix']+$settings['tarifs']['conf'];
	}
}

if(isset($_SESSION['nb_ticket']))
{
	$_SESSION['prix']=$_SESSION['prix']+$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket']->get_value());
}
$_SESSION['verif']=true;
 header("Location: ../recap_avant_paiement_parent.php");
?>