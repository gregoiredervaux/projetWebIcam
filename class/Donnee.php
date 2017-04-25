<?php

class Donnee
{
	protected $_value;
	protected $_type;
	protected $_verif;

	const choix_type=array('tel','email','nom','prenom','int','statut','promo','check','nb','id','psw','bool');


	public function get_verif()
	{
		return $this->_verif;
	}

	public function set_verif($val)
	{
		$this->_verif=$val;
	}

	public function get_value()
	{
		return $this->_value;
	}

	public function set_value($val)
	{
		$this->_value=$val;
	}

	public function get_type()
	{
		return $this->_type;
	}

	public function set_type($val)
	{
		$this->_type=$val;
	}

	function __construct($value,$nom)
	{
		$this->set_value($value);

		foreach (self::choix_type as $t)
		{
			if(preg_match("#^".$t."#",$nom)) // verifie si le nom de variable correspond a un type connu
			{$this->set_type($t);}
		}
		if ($this->get_type()==null)
		{
			throw new Exception("le champs \"".$nom."\" du formulaires doit commencer par \"tel\",\"email\", \"nom\", \"prenom\", \"nb\", \"statut\" ou \"promo\"");
		}
	}

	function __is_string()
	{
		return is_string($this->get_value());
	}

	function lengthLessThan($long)
	{
		if (is_string($this->get_value()))
		{
			return strlen($this->get_value()) < $long;
		}
		if (is_int($this->get_value()))
		{
			return $this->get_value() < $long;
		}
		else
		{
			throw new Exception('ce n\'est ni un entier ni une chaine de caractère');
		}

	}

	function isTel()
	{
		return preg_match("#^0[1-6789]([-. ]?[0-9]{2}){4}$#",$this->get_value())==1;
	}

	function isEmail()
	{
		return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$this->get_value())==1;
	}

	function isNom()
	{
		return (is_string($this->get_value()) && $this->lengthLessThan(50));
	}

	function isPrenom()
	{
		return $this->isNom($this->get_value());
	}

	function isStatut()
	{
		return ($this->get_value()=='parent' || $this->get_value()=='ingenieur' || $this->get_value()=='deja_pris');
	}

	function isNb()
	{
		try
		{
			return is_numeric($this->get_value());
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	function  isPromo()
	{
		try
		{
			return ($this->get_value()=='i5_plus' || $this->get_value()=='parent' || is_numeric($this->get_value()));
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	function isCheck()
	{
		return ($this->get_value()=='on');
	}

	function isId()
	{
		return is_numeric($this->get_value());
	}

	function isPsw()
	{
		$l=strlen($this->get_value());
		return preg_match("#[a-zA-Z0-9]{".$l."}#",$this->get_value())==1;
	}

	function isBool()
	{
		return is_bool($this->get_value());
	}

	function verif_value()
	{
		$test='is'.ucfirst($this->get_type());
		$this->set_verif($this->$test());
	}
	function __toString()
		{
			return $this->get_type().$this->get_value();
		}
}

?>
