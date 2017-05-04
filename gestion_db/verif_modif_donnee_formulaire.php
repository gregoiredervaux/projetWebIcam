<?php
require "/class/nettoyer.php";
$dico_donnee=array();

$_SESSION['erreur']=null;

//on evite toute faille XSS
foreach ($_POST as $key => $value)
{
	$_POST[$key]=Securise::html($value);
	$_POST[$key]=nettoyer($value);
}

foreach ($_POST as $key => $value)
{

	//extraction des données du post, vérifiaction des types d'input
	$dico_donnee[$key]= new Donnee($value,$key);
	//test des données du formulaire, vérifiaction des valeurs d'input
	

	$dico_donnee[$key]->verif_value();
	if (!isset($_SESSION[$key]))
	{
		$_SESSION[$key]=$dico_donnee[$key];
	
	}
	elseif($_SESSION[$key]->get_value()!=$dico_donnee[$key]->get_value())
	{
		$_SESSION[$key.'_old']=$_SESSION[$key];
		$_SESSION[$key]=$dico_donnee[$key];
	}
	if ($dico_donnee[$key]->get_verif()==false)
	{
		if ((isset($dico_erreur)))
		{
			$dico_erreur[$key]=$dico_donnee[$key];
		}
		else
		{
			$dico_erreur=array($key=>$dico_donnee[$key]);	
		}
	}
	if(preg_match('#^check#',$key))
	{
		if (($_SESSION[$key]->get_value()=='1' || $_SESSION[$key]->get_value()=='on') && (!isset($dico_donnee[$key])))
		{
			unset($_SESSION[$key]);
		}
	}
	
	if($_SESSION['nom_inv']->get_value()=='' && $_SESSION['prenom_inv']->get_value()=='' && $_SESSION['statut_inv']=='empty')
	{
		unset($dico_erreur['nom_inv']);
		unset($dico_erreur['prenom_inv']);
		unset($dico_erreur['nb_ticket_inv']);
		unset($dico_erreur['tel_inv']);
		$_SESSION['pas_inv']=true;
	}
}

if (!empty($dico_erreur))
{
	$_SESSION['erreur']=$dico_erreur;
	header('Location: form_modif_'.($_SESSION['statut']->get_value()));
	exit();
}
?>