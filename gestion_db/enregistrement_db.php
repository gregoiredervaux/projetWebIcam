<?php
session_start();
require "../class/Donnee.php";
echo("post");
var_dump($_POST);
echo("session");
var_dump($_SESSION);
$dico_donnee = array();
foreach ($_POST as $key => $value)
{
	//extraction des données du post
	$dico_donnee_test[$key]= new Donnee($value,$key);
	//test des données du formulaire
	if ($dico_donnee_test[$key]->get_type()==tel 
		&& $dico_donnee_test[$key]->i)
	{

	}

}


echo("dictionnaire");
var_dump($dico_donnee_test);


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

?>