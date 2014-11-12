<?php

class Image extends Writable
{
	var $file;
	var $galeries;
	
	function __construct($t)
	{
		parent::__construct($t,"files/images/");
	}
	
	function init($t){
		if(!$this->get())
		{
			parent::init($t);
			$this->file = $t;
			$this->galeries = array();
		}
	}
	
	function addGalerie($galerie)
	{
		if(!in_array($galerie->titre, $this->galeries) && $galerie->addImage($this->file))
		{
			array_push($this->galeries,$galerie->titre);
			$this->save();
		}
			
	}
	
	function save()
	{
		$obj = array("file" => $this->file,
					 "galeries" => $this->galeries
		);
		
		return parent::save($obj);
	}
	
	function get(){
		$res = parent::get();
		if($res != null){
			$this->file = $res->file;
			$this->galeries = json_decode(json_encode($res->galeries),true);
			return true;
		}
		
		return false;
	}
}
?>