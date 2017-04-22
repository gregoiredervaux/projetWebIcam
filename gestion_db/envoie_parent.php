<?php
require "../class/Donnee.php";
session_start();
// echo("post:");
// var_dump($_POST);

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

//on verifie si l'email renseigné au niveau de  l'enfant existe et si l'enfant n'a pas trop de personnes

$test_email_enf=$bd->prepare("SELECT COUNT(*) email_icam FROM :bd_icam WHERE @_icam=:@_icam");
$test_email_enf->execute(array('bd_icam' => $settings['confSQL']['bd_etudiant_icam'],'@_icam' => $_SESSION['email_enf']->get_value()));

if ($test_email_enf->fetch()==0)
{
	$_SESSION['erreur']['email_invalide']=true;
}




