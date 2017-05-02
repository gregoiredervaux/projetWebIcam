<?php
require "../class/nettoyer.php";
$dico_donnee=array();
// echo("session au depart des de l'enregistrement des données");
// var_dump($_SESSION);
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
	// echo("dico_donnee:".$key);
	// var_dump($dico_donnee[$key]);


	$dico_donnee[$key]->verif_value();
	if (!isset($_SESSION[$key]))
	{
		$_SESSION[$key]=$dico_donnee[$key];
		// echo($key." n'est pas definie \n");
	}
	elseif($_SESSION[$key]->get_value()!=$dico_donnee[$key]->get_value())
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
foreach ($_SESSION as $key => $value) 
{
	if(preg_match('#^check#',$key))
	{
		if(isset($_SESSION[$key]) && !isset($dico_donnee[$key]))
		{
			unset($_SESSION[$key]);
		}
	}
}


?>