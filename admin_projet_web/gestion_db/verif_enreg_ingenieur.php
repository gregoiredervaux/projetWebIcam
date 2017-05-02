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
unset($_SESSION['erreur']);
$_SESSION['pas_inv']=false;
// echo("session initiale");
// var_dump($_SESSION);
if (!empty($dico_erreur))
{
	// echo("dico");
	// var_dump($dico_erreur);
	
	foreach($dico_erreur as $key => $value)
	{
		// echo($key." => ".$dico_erreur[$key]->get_value());
		// var_dump($dico_erreur[$key]);
		if(!preg_match('#[inv]$#',$key))
		{
			$_SESSION['erreur'][$key]=$dico_erreur[$key];
		}
	}

	if($_SESSION['nom_inv']->get_value()=='' && $_SESSION['prenom_inv']->get_value()=='')
	{
		unset($dico_erreur['nom_inv']);
		unset($dico_erreur['prenom_inv']);
		unset($dico_erreur['nb_ticket_inv']);
		unset($dico_erreur['tel_inv']);
		$_SESSION['pas_inv']=true;
	}
}
if(!empty($dico_erreur))
{
	$_SESSION['erreur']=$dico_erreur;
	// var_dump($_SESSION['erreur']);
	// die();
	header("Location: ../form_ingenieur");
	exit();
	// echo("session");
	// var_dump($_SESSION['erreur']);
	// die();
	
}
// echo("session apres erreur");
// var_dump($_SESSION);
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



//on prepare une requette pour vérifier qu'il y a bien une place de libre !
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
	exit();
}


//on prepare une requette pour vérifier que la personne n'est pas enregistrée deux fois

$verif_info_double=$bd->prepare('SELECT count(*) FROM '.$bd_invite.' 
	WHERE nom REGEXP :nom AND prenom REGEXP :prenom AND email = :email');

$nom_reg='~*'.$nom;
$verif_info_double->bindParam('nom', $nom_reg, PDO::PARAM_STR);

$prenom_reg='~*'.$prenom;
$verif_info_double->bindParam('prenom', $prenom_reg, PDO::PARAM_STR);

$verif_info_double->bindParam('email', $email_inge, PDO::PARAM_STR);

$verif_info_double->execute();

$rep_verif_info_double=$verif_info_double->fetch();

// echo("recup_info double");
// var_dump($rep_verif_info_double);

if($rep_verif_info_double['count(*)']!='0')
{
	$_SESSION['erreur']['bool_doublons']=new Donnee (true,'bool_doublons');
	header('Location: ../form_ingenieur');
	exit();
}
else
{
	unset($_SESSION['erreur']['bool_doublons']);
}
$nb_pers=2;
if(isset($_SESSION['pas_inv']))
{
	if($_SESSION['pas_inv']==true)
	{
		$nb_pers=1;
	}
}

$_SESSION['verif']=true;
 header("Location: enreg_ingenieur.php");
?>
