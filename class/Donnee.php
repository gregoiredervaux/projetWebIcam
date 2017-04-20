<?php

class Donnee
{
	protected $_value;
	protected $_type;

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
		if (preg_match("#^tel#",$nom))
			{$this->set_type("tel");}
		elseif(preg_match("#^email#",$nom))
			{$this->set_type("email");}
		elseif(preg_match("#^nom#",$nom))
			{$this->set_type("nom");}
		elseif(preg_match("#^prenom#",$nom))
			{$this->set_type("prenom");}
		elseif(preg_match("#^nb#",$nom))
			{$this->set_type("nb");}
		elseif(preg_match("#^statut#",$nom))
			{$this->set_type("statut");}
		elseif(preg_match("#^promo#",$nom))
			{$this->set_type("promo");}
		else
			{throw new Exception("les champs \"names\" des formulaires doivent commencer par \"tel\",\"email\", \"nom\", \"prenom\", \"nb\", \"statut\" ou \"promo\"");}
	}

	function __is_int()
	{
		return is_int($this->get_value());
	}

		function __is_string()
	{
		return is_string($this->get_value());
	}

	function lenthlessThan(int $long)
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
			throw new Exception('ce n\'est ni un entier ni uen chaine de caractère');
		}

	}

	function istelnumber()
	{
		return preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#",$this->get_value());
	}

	function isemail()
	{
		return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$this->get_value());
	}
}

?>
