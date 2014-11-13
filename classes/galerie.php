<?php

class Galerie extends Writable
{
	var $titre;
	var $images;
	var $theme;
	var $creation;
	var $modification;
	var $icone;
	public static $LISTE_THEMES = array("Non classé","Abstrait","Animaux","Nature");
	public static $CLASS_THEMES = array("theme0","theme1","theme2","theme3");
	
	function __construct($t)
	{
		parent::__construct($t,"files/galeries/");
	}
	
	function init($t){
		if(!$this->get()){
			parent::init($t);
			$this->titre = $t;
			$this->theme = "default";
			$this->images = array();
			$this->creation = date("YmdHis");
			$this->modification = date("YmdHis");
			$this->icone = "default.png";
		}
	}
	
	function addImage($image)
	{
		if(!in_array($image, $this->images))
		{
			array_push($this->images,$image);
			if($this->icone == "default.png")
				$this->icone = $image;
			
			$this->modification = date("YmdHis");
			return $this->save();
		}
		
		return true;
	}
	
	function save(){
		$obj = array("titre" => $this->titre,
					"creation" => $this->creation,
					"theme" => $this->theme,
					"modification" => $this->modification,
					"icone" => $this->icone,
					"images" => $this->images);
		
		return parent::save($obj);
	}
	
	function get(){
		$res = parent::get();
		if($res != null){
			$this->titre = $res->titre;
			$this->creation = $res->creation;
			$this->theme = $res->theme;
			$this->modification = $res->modification;
			$this->icone = $res->icone;
			$this->images = json_decode(json_encode($res->images),true);
			return true;
		}
		
		return false;
	}
	
	function getIcone(){
		return (($this->icone == "default.png")?"img/":"photos/"). $this->icone;
	}
	
	function getTitre(){
		return join(" ",explode('_',$this->titre));
	}
	
	function getTaille(){
		return count($this->images);
	}
	
	function getDateCreation(){
		return $this->getDate($this->creation);
	}
	
	function getDateModification(){
		return $this->getDate($this->modification);
	}
	
	function getDate($d){
		$a = intval(substr($d,0,4));
		$m = intval(substr($d,4,2));
		$j = intval(substr($d,6,2));
		$h = intval(substr($d,8,2));
		$i = intval(substr($d,10,2));
		$s = intval(substr($d,12,2));
		
		return date("d/m/Y Ã  H:i:s",mktime($h,$i,$s,$m,$j,$a));
	}
}

?>