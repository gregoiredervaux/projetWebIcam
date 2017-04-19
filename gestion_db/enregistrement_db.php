<?php
session_start();
require "../class/Donnee.php";
$dico_donnee = array();
foreach ($_POST as $key => $value)
{
	'$'.$key = new Donnee($value);
	$dico_donnee[] = '$'.$key;
}
//require "../class/Place.php";

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
//test des données du formulaire



?>