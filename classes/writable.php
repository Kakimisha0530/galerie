<?php

class Writable
{
	var $nom;
	var $filepath;
	
	function __construct($t,$fl = "files/")
	{
		$text = explode(".", $t);
		$this->nom = ($text[0] == "")?$t:$text[0];
		$this->filepath = $fl;
		$this->init($t);
	}
	
	function init($t){
		
	}
	
	function save($obj)
	{
		$res = file_put_contents($this->filepath . "" . $this->nom . '.json', json_encode($obj));	
		return (!$res)?"erreur":$res;
	}
	
	function get()
	{
		if(file_exists($this->filepath . "" . $this->nom . '.json'))
		{
			$s = file_get_contents($this->filepath . "" . $this->nom  . '.json',FILE_USE_INCLUDE_PATH);
			$a = json_decode($s);
			return $a;
		}
		
		return null;
	}
	
}
?>