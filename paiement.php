<?php
require "/class/Donnee.php";
require "/class/Securise.php";
include ('/config.php');
session_start();

$prix=intval($_SESSION['prix']);

//paiement

$_SESSION['paiement']=true;
if(isset($_SESSION['modification']))
{
	header('Location: gestion_db/enreg_modif_'.$_SESSION['statut']->get_value().'.php');
	exit();
}
else
{
	header('Location: gestion_db/enreg_'.$_SESSION['statut']->get_value().'.php');
}
?>