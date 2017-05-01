<?php
session_start();
$_SESSION=array('deconnexion'=>'deconnexion');
header('Location: connexion.php');
 ?>