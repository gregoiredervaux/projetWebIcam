<?php




$settings=array(
		'emailContactGala'=>'inscriptiongalaicam@gmail.com',
		'confSQL'=>array(
			'sql_host'=>"localhost",
			'sql_db'   => 'projet_web',
            'sql_user' => "root",
            'sql_pass' => "",
            'bd_etudiant_icam' => 'etudiants_icam_lille_test',
            'bd_parent' => 'icam_parent',
            'bd_ingenieur' => 'icam_ingenieur',
            'bd_invite' => 'invite',
            'bd_admin' => 'administrateurs',
            'bd_icam_has_guest' => 'icam_parent',
            'bd_inge_has_guest' => 'inge_invite',
            'bd_parametre'=>'parametres'),
        'quotas' => array(
        	'parents' => 200,
        	'ingenieur' => 200),
        'tarifs'=> array(
            'place' => 20,
            'diner' => 20,
            'conf' => 3,
            'ticket_boisson' => 1),
        'security' => array(
            'prefix_salt' => 'galaicam',
            'suffix_salt' => 'promotion119',
            'default_salt' => 'mvpp6q7p7lamb3zw7915mp')
        );
try
    {
      $bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    }
    catch(Exeption $e)
    {
      die('erreur:'.$e->getMessage());
    } 
$parametre=$bd->prepare('SELECT prix_soiree, prix_diner, prix_conference, prix_ticket_boisson, quota_parent, quota_ingenieur FROM '.$settings['confSQL']['bd_parametre']);
$parametre->execute();
$valeurs=$parametre->fetch();
$settings['quotas']=array('parents'=>$valeurs['quota_parent'], 
                          'ingenieur'=>$valeurs['quota_ingenieur']);
$settings['tarifs']=array(
                          'place' => $valeurs['prix_soiree'],
                          'diner' => $valeurs['prix_diner'],
                          'conf' => $valeurs['prix_conference'],
                          'ticket_boisson' => $valeurs['prix_ticket_boisson']);


?>