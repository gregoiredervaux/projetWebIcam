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

var_dump($_SESSION);
die();

foreach ($settings['confSQL'] as $key => $value) {
	$settings['confSQL'][$key]=Securise::html($value);
}

$verif=$bd->prepare('SELECT count(*) FROM '.$settings['confSQL']['bd_invite'].' WHERE email= :email AND psw= :psw');

$verif->bindParam('email', $email, PDO::PARAM_STR);
$verif->execute();
