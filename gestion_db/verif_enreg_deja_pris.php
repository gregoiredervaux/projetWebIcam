<?php
require "../class/Donnee.php";
require "../class/Securise.php";
include ('../config.php');
session_start();



//initialisation de la connection dans l'objet PDO

include ('../config.php');

$confSQL=$settings['confSQL'];
try
{
	$bd = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass']);
}
catch(Exeption $e)
{
	die('erreur:'.$e->getMessage());
}

//verification des données
include "verif_donnee_formulaire.php";

foreach ($settings['confSQL'] as $key => $value) {
	$settings['confSQL'][$key]=Securise::html($value);

}

$email=$_SESSION['email']->get_value();
$psw=$_SESSION['psw']->get_value();
$psw_salted=$settings['security']['prefix_salt'].$psw.$settings['security']['suffix_salt'];



$verif=$bd->prepare('SELECT id,nom,prenom,promo,telephone,ticket_boisson,diner,conference,psw FROM '.$settings['confSQL']['bd_invite'].' WHERE email= :email');


$verif->bindParam('email', $email, PDO::PARAM_STR);

$verif->execute();
// echo('requete:');
// var_dump($verif);
// echo('email');
// var_dump($email);

$sortir=false;
while ($info_recup = $verif->fetch())
{
	$psw_hash=password_hash($psw_salted,PASSWORD_DEFAULT,array('salt' => $settings['security']['default_salt']));
	// echo("info_recup");
	// var_dump($info_recup);
	// echo("psw_hashé");
	// var_dump($psw_hash);
	$psw_verif=password_verify($psw_salted,$info_recup['psw']);
	// echo('verif');
	// var_dump($psw_verif);
	if ($psw_verif)
	{
		$_SESSION['verif']=true;
		$_SESSION['id']=new Donnee($info_recup['id'],'id');
		if ($info_recup['promo']=='parent')
		{
			$_SESSION['statut']=new Donnee('parent','statut');
			$_SESSION['nom']=new Donnee($info_recup['nom'],'nom');
			$_SESSION['prenom']=new Donnee($info_recup['prenom'],'prenom');
			$_SESSION['tel']=new Donnee('0'.$info_recup['telephone'],'tel');
			$_SESSION['nb_ticket']=new Donnee($info_recup['ticket_boisson'],'nb_ticket');
			$_SESSION['check_diner']=new Donnee($info_recup['diner'],'check_diner');
			$_SESSION['check_conference']=new Donnee($info_recup['conference'],'check_conference');
		}
		else
		{
			$verif_inv=$bd->prepare('SELECT id_invite FROM '.$settings['confSQL']['bd_inge_has_gest'].' WHERE id_inge= :id_inge');
			$verif_inv->bindParam('id_inge', $info_recup['id'], PDO::PARAM_STR);
			$verif_inv->execute();
			$recup_verif_inv=$verif_inv->fetch();
			$_SESSION['statut_inv']='new';
			if(isset($recup_verif_inv['id_invite']))
			{

				$get_info_inv=$bd->prepare('SELECT nom,prenom,telephone FROM '.$settings['confSQL']['bd_invite'].' WHERE id= :id' );
				$get_info_inv->bindParam('id', $recup_verif_inv['id_invite'], PDO::PARAM_STR);
				$get_info_inv->execute();

				$recup_get_info_inv=$get_info_inv->fetch();

				$_SESSION['id_inv']=new Donnee($recup_get_info_inv['id_invite'],'id_inv');
				$_SESSION['nom_inv']=new Donnee($recup_get_info_inv['nom'],'nom_inv');
				$_SESSION['prenom_inv']=new Donnee($recup_get_info_inv['prenom'],'prenom_inv');
				$_SESSION['tel_inv']=new Donnee('0'.$recup_get_info_inv['telephone'],'tel_inv');
				$_SESSION['statut_inv']='old';

			}
			else
			{
				$_SESSION['statut_inv']='empty';
			}

			$_SESSION['statut']=new Donnee('ingenieur','statut');
			$_SESSION['nom']=new Donnee($info_recup['nom'],'nom');
			$_SESSION['prenom']=new Donnee($info_recup['prenom'],'prenom');
			$_SESSION['tel']=new Donnee('0'.$info_recup['telephone'],'tel');
			$_SESSION['nb_ticket']=new Donnee($info_recup['ticket_boisson'],'nb_ticket');
			$_SESSION['check_conference']=new Donnee($info_recup['conference'],'check_conference');	
		}
		$_SESSION['modification']=true;
		$sortir=true;
	}
}

if($sortir==false)
{
	$_SESSION['erreur']['bool_mauvais_psw']=new Donnee(true, 'bool_mauvais_psw');
	header('Location: ../form_deja_pris.php');
	exit();
}
header('Location: ../form_modif_'.($_SESSION['statut']->get_value()));