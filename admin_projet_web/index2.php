<?php 
require "config.php";
require "Auth_class.php";
session_start();

try
{
	$bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
	die('erreur:'.$e->getMessage());
}



if (isset($_POST['email']) && isset($_POST['password']))
{
	// if (isset($_SESSION['statut']))
	// {
	// 	if ($_SESSION['statut']->get_value()!=$_POST['statut'])
	// 	{
	// 		$_SESSION=array();
	// 	}
	// }
	// $_SESSION['statut']=new Donnee ('parent','statut');
	login($_POST);
}
else
{
	echo("le zboub fut vaincu");
	var_dump($_POST);
	// header('./connexion.php');
}
 ?>