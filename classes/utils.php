<?php

function getFormVar($name){
	return ($_POST[$name] != null)? $_POST[$name] : $_GET[$name];
}

function displayContentOf($rep, $name = false)
{
	$liste = array();
	$tab = scandir("$rep");
	foreach ($tab as $key => $val)
	{
		$ch = explode(".", $val);
		if($ch[0] != "")
			$liste[$key] = ($name)?$ch[0]:$val;
	}
	
	return $liste;
}

function displayCss()
{
	print ('<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">');
	print ('<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">');
	print ('<link href="css/style.css" rel="stylesheet" type="text/css">');
	//print ('<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">');
}

function displayJavascript(){
	print ('<script src="js/jquery-1.11.1.js"></script>');
	print ('<script src="bootstrap/js/bootstrap.min.js"></script>');
}

function getSimpleString($chaine){
	$caracteres = array(
			'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', '@' => 'a',
			'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', '€' => 'e',
			'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
			'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'µ' => 'u',
			'Œ' => 'oe', 'œ' => 'oe',
			'$' => 's');
	//remplacer les char speciaux par des char simples
	$chaine = strtr($chaine, $caracteres);
	//remplacer tout autre caractere non alpha-numerique par un '_'
	$chaine = preg_replace('#[^A-Za-z0-9]+#', '_', $chaine);
	
	foreach ($caracteres as $key => $val)

	return $chaine;
}