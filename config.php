<?php


$settings=array(
		'emailContactGala'=>'guillaume.dubois-malafosse@2019.icam.fr',
		'confSQL'=>array(
			'sql_host'=>"localhost",
			'sql_db'   => 'projet_web',
            'sql_user' => "root",
            'sql_pass' => "",
            'bd_etudiant_icam' => 'etudiants_icam_lille_test',
            'bd_parent' => 'icam_parent',
            'bd_ingenieur' => 'icam_ingenieur',
            'bd_invite' => 'invite',
            'bd_icam_has_gest' => 'icam_parent',
            'bd_inge_has_gest' => 'inge_invite'),
        'quotas' => array(
        	'parents' => 200,
        	'ingenieurs' => 200),
        'tarifs'=> array(
            'place' => 20,
            'diner' => 20,
            'conf' => 3,
            'buffet' => 10,
            'ticket_boisson' => 1),
        'security' => array(
            'prefix_salt' => 'galaicam',
            'suffix_salt' => 'promotion119')
        )
?>


