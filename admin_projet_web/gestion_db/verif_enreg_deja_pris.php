<?php
require "../class/Donnee.php";
require "../class/Securise.php";
include ('../config.php');
session_start();

$_SESSION=array('email_admin' => $_SESSION['email_admin']);

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
$id=$_GET['id'];


$verif=$bd->prepare('SELECT id,nom,prenom,promo,telephone,ticket_boisson,diner,conference,psw,email FROM '.$settings['confSQL']['bd_invite'].' WHERE id= :id');

$verif->bindParam('id', $id, PDO::PARAM_STR);

$verif->execute();
$info_recup = $verif->fetch();


		$_SESSION['verif']=true;
		$_SESSION['id']=new Donnee($info_recup['id'],'id');
		if ($info_recup['promo']=='parent')
		{
			$_SESSION['statut']=new Donnee('parent','statut');
			$_SESSION['nom']=new Donnee($info_recup['nom'],'nom');
			$_SESSION['prenom']=new Donnee($info_recup['prenom'],'prenom');
			$_SESSION['email']=new Donnee($info_recup['email'],'email');
			$_SESSION['tel']=new Donnee('0'.$info_recup['telephone'],'tel');
			$_SESSION['nb_ticket']=new Donnee($info_recup['ticket_boisson'],'nb_ticket');
			$_SESSION['check_diner']=new Donnee($info_recup['diner'],'check_diner');
			$_SESSION['check_conference']=new Donnee($info_recup['conference'],'check_conference');
		}
		else
		{
			$verif_inv=$bd->prepare('SELECT id_invite FROM '.$settings['confSQL']['bd_inge_has_guest'].' WHERE id_inge= :id_inge');
			$verif_inv->bindParam('id_inge', $info_recup['id'], PDO::PARAM_STR);
			$verif_inv->execute();
			$recup_verif_inv=$verif_inv->fetch();
			$_SESSION['statut_inv']='new';
			if(isset($recup_verif_inv['id_invite']))
			{

				$get_info_inv=$bd->prepare('SELECT nom,prenom,telephone,ticket_boisson FROM '.$settings['confSQL']['bd_invite'].' WHERE id= :id' );
				$get_info_inv->bindParam('id', $recup_verif_inv['id_invite'], PDO::PARAM_STR);
				$get_info_inv->execute();

				$recup_get_info_inv=$get_info_inv->fetch();

				$_SESSION['id_inv']=new Donnee($recup_verif_inv['id_invite'],'id_inv');
				$_SESSION['nom_inv']=new Donnee($recup_get_info_inv['nom'],'nom_inv');
				$_SESSION['prenom_inv']=new Donnee($recup_get_info_inv['prenom'],'prenom_inv');
				$_SESSION['tel_inv']=new Donnee('0'.$recup_get_info_inv['telephone'],'tel_inv');
				$_SESSION['nb_ticket_inv']=new Donnee($recup_get_info_inv['ticket_boisson'],'nb_ticket_inv');

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
			$_SESSION['email']=new Donnee($info_recup['email'],'email');
			$_SESSION['nb_ticket']=new Donnee($info_recup['ticket_boisson'],'nb_ticket');
			$_SESSION['check_conference']=new Donnee($info_recup['conference'],'check_conference');	
		}
		$_SESSION['modification']=true;

header('Location: ../form_modif_'.($_SESSION['statut']->get_value()));
exit();