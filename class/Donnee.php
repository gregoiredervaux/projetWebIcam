<?php

class Donnee
{
	protected $value;

	function get_value()
	{
		return $this->$value;
	}

	function set_value($val)
	{
		$this->$value=$val;
	}

	function __construct($pvalue)
	{
		$this->$value=$pvalue;
	}

	function is_int()
	{
		return is_int($this->value);
	}

		function is_string()
	{
		return is_string($this->value);
	}

	function lenthlessThan(int $long)
	{
		if (is_string($this->$value))
		{
			return strlen($this->$value) < $long;
		}
		if (is_int($this->$value))
		{
			return $this->$value < $long;
		}
		else
		{
			throw new Exception('ce n\'est ni un entier ni uen chaine de caractère');
		}

	}

	function istelnumber()
	{
		return preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#",$this->$value);
	}

	function isemail()
	{
		return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$this->$value);
	}
}

?>
