<?php
include 'classes/utils.php';
include 'classes/writable.php';
include 'classes/galerie.php';
include 'classes/image.php';

$galerie = new Galerie("");

if(getFormVar('ajout') == '1'){
	
	$titre = getFormVar('titre');
	$images = getFormVar('images');
	$theme = getFormVar("theme");
	$galerie->nom = getSimpleString($titre);
	$galerie->titre = $titre;
	$galerie->theme = $theme;
	foreach ($images as $key => $val) {
		$img = new Image($val);
		$img->addGalerie($galerie);
	}
	$galerie->save();
	header("location: galerie.php?galerie=" . getSimpleString($titre));
}
else if(getFormVar("update") == '1'){
	$titre = getFormVar("galerie");
	$galerie = new Galerie("");
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php displayCss(); ?>
<style type="text/css">
#view{
margin-top:20px;
}
</style>
<title>GALERIE-AJOUTER UNE GALERIE</title>
<script type="text/javascript">
function viewImage(lien)
{
	var elt = document.getElementById('imgView');
	elt.setAttribute("src", "./photos/" + lien);
	elt = document.getElementById('view');
	if(elt.style.display == "none")
		elt.style.display = "block";
}

function viewIcone(node)
{
	var elt1 = document.getElementById('iconeView1');

	if (node.files && node.files[0])
	{
        var reader = new FileReader();      
        reader.onload = function (e) {
        	elt1.setAttribute("src",e.target.result);
        };
        
        reader.readAsDataURL(node.files[0]);
    }
		
	var elt = document.getElementById('iconeView');
	if(elt.style.display == "none")
		elt.style.display = "block";	
}

function select(element){
	if(element.parentNode.id != "images"){
		element.setAttribute("selected","selected");
		document.getElementById('images').appendChild(element);
	}
	else{
		element.removeAttribute("selected");
		document.getElementById('photos').appendChild(element);
	}
}

function submitForm(){
	
}

</script>
</head>
    <body>
    <div class="container">
    	<?php include 'header.php';?>
    	<button class="back bleu_b" title="Retour à  l'accueil" 
			onclick="location.href='./'"></button>
    	<h3 align="center">Nouvelle Galerie</h3>
    	<div class="space"></div>
    	<div class='themeForm'>
    	<div class="col-sm-6">
	    	<form id="themeForm" name="themeForm" action="#" method="post" enctype="multipart/form-data">
	    		<label for="titre">Titre : </label>
	    		<input type="text" name='titre' id='titre' placeholder="Veuillez saisir un titre sans carateres speciaux svp"
	    		value="<?php print($galerie->titre); ?>">
			  	<div class="space_min"></div>
			  	<label for="theme">Thème : </label>
	    		<select name='theme' id='theme'>
	    		<?php
		    		for ($i = 0;$i < count(Galerie::$LISTE_THEMES);$i++){
		    			print("<option value=\"" . Galerie::$CLASS_THEMES[$i] . "\"");
		    			if($galerie->theme == Galerie::$CLASS_THEMES[$i])
		    				print(" selected");
		    			print(" >");
		    			print(Galerie::$LISTE_THEMES[$i] . "</option>\n");
					}
	    		?>
	    		</select>
			  	<div class="space_min"></div>
			  	<div class="space"> </div>
			  	<select id="photos" style="width:200px" multiple="multiple" size="10">
			  	<?php 
			  		$liste = displayContentOf('photos');
			  		foreach ($liste as $key => $val)
			  		{
			  			if(!in_array($val,$galerie->images))
			  				print("<option value='$val' onclick='viewImage(this.value)' ondblclick='select(this)'>$val</option>\n");
			  		}
			  	?>
				</select>
				<select id="images" style="width:200px" name="images[]" multiple="multiple" size="10">
					<option value="0" disabled='disabled'>PHOTOS</option>
					<?php 
				  		foreach ($galerie->images as $key => $val)
				  		{
				  			print("<option value='$val' onclick='viewImage(this.value)' ondblclick='select(this)'>$val</option>\n");
				  		}
			  		?>
				</select>
				<p> </p>
				<input type="hidden" name='ajout' value='1'>
			    <input name="submit" type="submit" value="Ajouter" id="submit">
		    </form>
		    </div>
		    <div class="col-sm-6">
		    <div id="view" class="imgPetit" style="display:none;">
					<img id="imgView" src=''>
			</div>
			</div>
    	</div>
    </div>
    </body>
</html>