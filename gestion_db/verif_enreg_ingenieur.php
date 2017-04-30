<?php
require "../class/Donnee.php";
require "../class/Securise.php";
include ('../config.php');
session_start();

//initialisation de la connection dans l'objet PDO
$confSQL=$settings['confSQL'];
try
{
	$bd = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass']);
}
catch(Exeption $e)
{
	die('erreur:'.$e->getMessage());
}

//verifie si les données rentrées correspondent aux données demandées
include "verif_donnee_formulaire.php";

//contre faille XSS sur le dossiers settings qui va venir du serveur donc sujet a modification.
foreach ($settings['confSQL'] as $key => $value) {
	$settings['confSQL'][$key]=Securise::html($value);

}

//initialisation des variables

$nom=$_SESSION['nom']->get_value();
$prenom=$_SESSION['prenom']->get_value();
$email_inge=$_SESSION['email']->get_value();
$nb_ticket=$_SESSION['nb_ticket']->get_value();
$nb_ticket_inv=$_SESSION['nb_ticket_inv']->get_value();
$conf=$_SESSION['check_conference']->get_value();



//on prepare une requette pour vérifier qu'il y a bien une place de libre avec cet enfant !
$nb_max=$settings['quotas']['ingenieurs'];
$bd_invite=$settings['confSQL']['bd_invite'];

$valid_nb_place=$bd->prepare ('SELECT count(*) FROM '.$bd_invite.' WHERE promo !=\'parent\'');

$valid_nb_place->execute();

//on recupere les données en sortie de requette
$rep_valide_nb_place=$valid_nb_place->fetch();

if (intval($rep_valide_nb_place)>=$nb_max)
{
	$_SESSION['erreur']['bool_nb_place_depasse']=new Donnee (true,'bool_nb_place_depasse');
	header('Location: ../index.php');
}


//on prepare une requette pour vérifier que la personne n'est pas enregistrée deux fois

$verif_info_double=$bd->prepare('SELECT count(*) FROM '.$bd_invite.' 
	WHERE '.$bd_inv.'.nom REGEXP :nom AND '.$bd_inv.'.prenom REGEXP :prenom AND '.$bd_invite.'.email = :email');

$nom_reg='~*'.$nom;
$verif_info_double->bindParam('nom', $nom_reg, PDO::PARAM_STR);

$prenom_reg='~*'.$prenom;
$verif_info_double->bindParam('prenom', $prenom_reg, PDO::PARAM_STR);

$verif_info_double->bindParam('email', $email_enf, PDO::PARAM_STR);

$verif_info_double->execute();

$rep_verif_info_double=$verif_info_double->fetch();

if($rep_verif_info_double['count(*)']!='0')
{
	$_SESSION['erreur']['bool_doublons']=new Donnee (true,'bool_doublons');
	header('Location: ../form_'.($_SESSION['statut']->get_value()));
}
else
{
	unset($_SESSION['erreur']['bool_doublons']);
}

$_SESSION['prix']=2*$settings['tarifs']['place'];
if(isset($_SESSION['check_conference']))
{
	if($_SESSION['check_conference']->get_value()=='on')
	{
		$_SESSION['prix']=$_SESSION['prix']+2*$settings['tarifs']['conf'];
	}
}

if(isset($_SESSION['nb_ticket']))
{
	$_SESSION['prix']=$_SESSION['prix']+$settings['tarifs']['ticket_boisson']*intval($_SESSION['nb_ticket']->get_value());
}
$_SESSION['verif']=true;
 header("Location: ../recap_avant_paiement_ingenieur.php");
?>
