<?php
session_start();
$_SESSION['donnée_formulaires']
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

