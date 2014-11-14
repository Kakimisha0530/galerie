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

function isGalerie(){
	
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
			'Ã€' => 'a', 'Ã�' => 'a', 'Ã‚' => 'a', 'Ã„' => 'a', 'Ã ' => 'a', 'Ã¡' => 'a', 'Ã¢' => 'a', 'Ã¤' => 'a', '@' => 'a',
			'Ãˆ' => 'e', 'Ã‰' => 'e', 'ÃŠ' => 'e', 'Ã‹' => 'e', 'Ã¨' => 'e', 'Ã©' => 'e', 'Ãª' => 'e', 'Ã«' => 'e', 'â‚¬' => 'e',
			'ÃŒ' => 'i', 'Ã�' => 'i', 'ÃŽ' => 'i', 'Ã�' => 'i', 'Ã¬' => 'i', 'Ã­' => 'i', 'Ã®' => 'i', 'Ã¯' => 'i',
			'Ã’' => 'o', 'Ã“' => 'o', 'Ã”' => 'o', 'Ã–' => 'o', 'Ã²' => 'o', 'Ã³' => 'o', 'Ã´' => 'o', 'Ã¶' => 'o',
			'Ã™' => 'u', 'Ãš' => 'u', 'Ã›' => 'u', 'Ãœ' => 'u', 'Ã¹' => 'u', 'Ãº' => 'u', 'Ã»' => 'u', 'Ã¼' => 'u', 'Âµ' => 'u',
			'Å’' => 'oe', 'Å“' => 'oe',
			'$' => 's');
	//remplacer les char speciaux par des char simples
	$chaine = strtr($chaine, $caracteres);
	//remplacer tout autre caractere non alpha-numerique par un '_'
	$chaine = preg_replace('#[^A-Za-z0-9]+#', '_', $chaine);
	
	foreach ($caracteres as $key => $val)

	return $chaine;
}