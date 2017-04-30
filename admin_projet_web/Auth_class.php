<?php 

function login($d,$bd,$settings){
 	$d=array(
 		'email' => $d['email'],
 		'password' => $d['password'],
 		);
 	$recup_admin=$bd->query('SELECT email, password FROM '.$settings['confSQL']['bd_admin']);
 	
 	while($donnee = $recup_admin->fetch()){
 		if (($donnee['email']==$d['email']) && ($donnee['password']==$d['password'])){
 			return True;
 		}
 	}
 	$recup_admin->closeCursor(); // Termine le traitement de la requête
 	return False;

 	var_dump($recup_admin);
 	die();
 		
}

 ?>
