<?php
include './classes/utils.php';
include './classes/writable.php';
include './classes/galerie.php';
include './classes/image.php';

if(getFormVar('ajout') == '1'){
	
	$rep = "./photos/";
	$name = $_FILES['img']['name'];
	$img = $rep . basename($name);
	if (move_uploaded_file($_FILES['img']['tmp_name'], $img))
	{
		$themes = getFormVar('galeries');
		$image = new Image($name);
		foreach ($themes as $key => $val)
		{
			$galerie = new Galerie($val);
			$image->addTheme($galerie);
		}
	}
	else {
		echo "Attaque potentielle par tÈlÈchargement de fichiers.
          Voici plus d'informations :\n";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php displayCss(); ?>
<title>GALERIE-AJOUTER UNE IMAGE</title>
<script type="text/javascript">
function viewImage(node)
{
	var elt1 = document.getElementById('imgView1');
	var elt2 = document.getElementById('imgView2');

	if (node.files && node.files[0])
	{
        var reader = new FileReader();      
        reader.onload = function (e) {
        	elt1.setAttribute("src",e.target.result);
        	elt2.setAttribute("src",e.target.result);
        }
        
        reader.readAsDataURL(node.files[0]);
    }
		
	var elt = document.getElementById('view');
	if(elt.style.display == "none")
		elt.style.display = "block";	
}

function select(element){
	if(element.parentNode.id != "galeries"){
		element.setAttribute("selected","selected");
		document.getElementById('galeries').appendChild(element);
	}
	else{
		element.removeAttribute("selected");
		document.getElementById('listThemes').appendChild(element);
	}
}
</script>
</head>
    <body>
    <div class="container">
    	<?php include 'header.php';?>
    	<button class="back rose_b" title="Retour √† l'accueil" 
			onclick="location.href='index.php'"></button>
    	<h3 align="center">Nouvelle Image</h3>
    	<div class="space"></div>
    	<div class='imgForm col-sm-12 col-xs-12 row'>
	    	<form id="imgForm" name="imgForm" action="#" method="post" enctype="multipart/form-data">
	    		<label for="img">Image : </label>
	    		<input type="hidden" name="MAX_FILE_SIZE" value="700000" />
	    		<input type="file" name='img' id='img' onchange="viewImage(this);" accept=".jpg,.png">
			  	<div class="space"></div>
			  	<div class='affichage' id="view" style="display:none;">
				  	<div class="imgPetit">
				  		<p>Aper√ßu vignette : </p>
						<img id="imgView1" src=''>
					</div>
					<div class="space"> </div>
					<div class="imgGrand">
						<p>Aper√ßu photo : </p>
						<img id="imgView2" src=''>
					</div>
			  	</div>
			  	<div class="space"> </div>
			  	<div class="space"> </div>
			  	<select id="listThemes" style="width:300px" multiple="multiple" size="10">
			  	<?php 
			  		$liste = displayContentOf('files/galeries',true);
			  		foreach ($liste as $key => $val)
			  		{
			  			print("<option value='$val' ondblclick='select(this)'>$val</option>\n");
			  		}
			  	?>
				</select>
				<select id="galeries" style="width:300px" name="galeries[]" multiple="multiple" size="10">
					<option value="0" disabled='disabled'>Galeries</option>
				</select>
				<div class="space"> </div>
				<input type="hidden" name='ajout' value='1'>
			    <input name="submit" type="submit" value="Ajouter" id="submit">
		    </form>
		    <div class="space"></div>
    	</div>
    </div>
    </body>
</html>