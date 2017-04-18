<?php

class Place{

	protected $id;
	protected $nom;
	protected $prenom
	protected $email
	protected $tel
	protected $date_inscription
	protected $prix
	protected $conference
	protected $diner
	protected $ticket_boisson
	protected $promo
	protected $id_icam

	function __construct($pid,$pnom,$pprenom,$pemail,$ptel,$pdate_inscription,$pprix,$pconference,$pdiner,$pticket_boisson,$ppromo,$pid_icam)
	{
		$this->$id=$pid;
		$this->$nom=$pnom;
		$this->prenom=$pprenom;
		$this->$email=$pemail;
		$this->$tel=$ptel;
		$this->$date_inscription=$pdate_inscription;
		$this->$prix=$pprix;
		$this->$conference=$pconference;
		$this->$diner=$pdiner;
		$this->$ticket_boisson=$pticket_boisson;
		$this->$promo=$ppromo;
		$this->$id_icam=$pid_icam;
	}

	function __construct()
	{
		$this->$id=0;
		$this->$nom="noName";
		$this->prenom="noFirstName";
		$this->$email="noEmail";
		$this->$tel="noTel";
		$this->$date_inscription="00-00-0000";
		$this->$prix=0;
		$this->$conference=0;
		$this->$diner=0;
		$this->$ticket_boisson=0;
		$this->$promo="noPromo";
		$this->$id_icam=0;
	}
}