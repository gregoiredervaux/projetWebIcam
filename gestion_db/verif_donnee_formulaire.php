<?php

$dico_donnee=array();
// echo("session au depart des de l'enregistrement des données");
// var_dump($_SESSION);
$_SESSION['erreur']=null;

//on evite toute faille XSS
foreach ($_POST as $key => $value)
{
	$_POST[$key]=Securise::html($value);
}

foreach ($_POST as $key => $value)
{

	//extraction des données du post, vérifiaction des types d'input
	$dico_donnee[$key]= new Donnee($value,$key);
	//test des données du formulaire, vérifiaction des valeurs d'input
	// echo("dico_donnee:".$key);
	// var_dump($dico_donnee[$key]);


	$dico_donnee[$key]->verif_value();
	if (!isset($_SESSION[$key]))
	{
		$_SESSION[$key]=$dico_donnee[$key];
		// echo($key." n'est pas definie \n");
	}
	elseif($_SESSION[$key]!=$dico_donnee[$key])
	{
		// echo("modification de la valeur: ".$_SESSION[$key]."   ");
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
}

if (!empty($dico_erreur))
{
	$_SESSION['erreur']=$dico_erreur;
	header('Location: ../form_'.($_SESSION['statut']->get_value()));
	exit();
}
// echo("session:");
// var_dump($_SESSION);
?>