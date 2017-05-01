<?php 

function login($d,$bd,$settings){
 	$d=array(
 		'email_admin' => $d['email_admin'],
 		'password' => $d['password'],
 		);
 	$recup_admin=$bd->query('SELECT email, password FROM '.$settings['confSQL']['bd_admin']);
 	
 	while($donnee = $recup_admin->fetch()){
 		if (($donnee['email']==$d['email_admin']) && ($donnee['password']==$d['password'])){
 			return True;
 		}
 	}
 	$recup_admin->closeCursor(); // Termine le traitement de la requête
 	return False;
 		
}

function findIcamGarant($id,$bd,$settings){  // return 0-> id invite 1-> id icam 2->inge ou icam(pour parent)
	$promo=$bd->query('SELECT promo FROM '.$settings['confSQL']['bd_invite'].' WHERE id='.$id);
	$info=$promo->fetch();
	if (!isset($info['promo'])){
		$id_return=$bd->query('SELECT id_inge FROM '.$settings['confSQL']['bd_inge_has_guest'].' WHERE id_invite='.$id);

		return array($id, $id_return->fetch(),'inge');
	}

	elseif ($info['promo']=='parent'){
		$id_return=$bd->query('SELECT id_icam FROM '.$settings['confSQL']['bd_icam_has_guest'].' WHERE id_parent1='.$id.' OR id_parent2='.$id);
		return array($id, $id_return->fetch(), 'icam');
	}
	else{
	return array($id, $id, 'inge');
	}
}
	
 ?>
