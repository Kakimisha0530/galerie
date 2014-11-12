<?php
include 'classes/utils.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php displayCss(); ?>
<title>GALERIE</title>
<script type="text/javascript">
function openURL(url)
{
	window.location = url + ".php";
}
</script>
</head>
    <body>
    <div class="container">
	    <?php include 'header.php';?>
	    <div class="space"></div>
	    <div class="menu">
	    	<div class="addImage" onclick="openURL('addImage');">
	    		<div class="icone"></div>
	    		<div class="texte">Nouvelle image</div>
	    	</div>
	    	<div class="view" onclick="openURL('liste');">
	    	<div class="texte">Toutes les galeries</div>
	    	</div>
	    	<div class="addGalerie" onclick="openURL('addGalerie');">
	    		<div class="icone"></div>
	    		<div class="texte">Nouvelle galerie</div>
	    	</div>
	    </div>
    </div>
    </body>
</html>