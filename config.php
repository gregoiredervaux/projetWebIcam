<?php


$settings=array(
		'emailContactGala'=>'guillaume.dubois-malafosse@2019.icam.fr',
		'confSQL'=>array(
			'sql_host'=>"localhost",
			'sql_db'   => 'test_bd_parent_inge',
            'sql_user' => "root",
            'sql_pass' => "",
            'bd_etudiant_icam' => 'etudiant_icam',
            'bd_parent' => 'parent',
            'bd_ingenieur' => 'ingenieur',
            'bd_invite' => 'invite',
            'bd_icam_has_gest' => 'icam_has_gest',
            'bd_inge_has_gest' => 'inge_has_gest'),
        'quotas' => array(
        	'parents' => 200,
        	'ingenieurs' => 200),
        'input_fields'=>array(
            'parent'=> array(
                'nom',
                'prenom',
                'email',
                'email_enfant',
                'tel',
                'conférence',
                'diner',
                'nb_ticket_boisson',
                'creneaux',
            ),
            'ingenieur'=>array(
                'promo',
                'nom',
                'prenom',
                'email',
                'tel',
                'conférence',
                'nb_ticket_boisson',
                'nom_invite',
                'prenom_invite',
                'tel_invite',
                'conférence_invit',
                'buffet_i5_plus',
                'creneaux'
            ),
        )
    )
?>


