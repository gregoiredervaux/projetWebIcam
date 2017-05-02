<?php 
require "config.php";
      try
    {
      $bd = new PDO('mysql:host='.$settings['confSQL']['sql_host'].';dbname='.$settings['confSQL']['sql_db'].';charset=utf8',$settings['confSQL']['sql_user'],$settings['confSQL']['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    }
    catch(Exeption $e)
    {
      die('erreur:'.$e->getMessage());
    } 
$psw='loutre';
$psw_hash=password_hash($psw,PASSWORD_DEFAULT);
$bd->query('UPDATE administrateurs SET password=\''.$psw_hash.'\' WHERE id=1 OR id=2');

 ?>