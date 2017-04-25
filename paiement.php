<?php
require "../class/Donnee.php";
require "../class/Securise.php";
include ('../config.php');
session_start();

$prix=intval($_SESSION['prix']);

if (isset($_SESSION['ancien_prix']))
{
	if($prix-$_SESSION['ancien_prix']>0)
	{
		$prix=$prix-$_SESSION['ancien_prix'];
	}
}

//paiement

$_SESSION['paiement']=true;
header('Location: gestion_db/enreg_parent');
?>