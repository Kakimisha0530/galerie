<?php
include 'classes/utils.php';
include 'classes/writable.php';
include 'classes/galerie.php';
$liste = displayContentOf("files/galeries");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php displayCss(); ?>
<?php displayJavascript(); ?>
<script>
function filtrer(ind){
	if(ind >= 0){
		$(".media").filter(function(index){
			return !$(this).hasClass("theme" + ind);
		}).hide();
		$(".media").filter(function(index){
			return $(this).hasClass("theme" + ind);
		}).fadeIn();
	}
	else
		$(".media").fadeIn();
}
</script>
<title>GALERIE-AJOUTER UNE IMAGE</title>
</head>
    <body>
    <div class="container">
    	<?php include 'header.php';?>
    	<button class="back vert_b" title="Retour à l'accueil" 
			onclick="location.href='index.php'"></button>
	    <div class="themes">
	    <?php 
	    for($i = 0;$i < count(Galerie::$LISTE_THEMES);$i++){
			print("<button onclick=\"filtrer($i)\">" . Galerie::$LISTE_THEMES[$i] . "</button>");
		}
		print("<button onclick=\"filtrer(-1)\">Tous les thèmes</button>");
	    ?>
	    
	    </div>
    	<div class="space"></div>
    	<div class='themeForm col-sm-12 col-xs-12 row'>
    	<div class='galeries'>
    		<?php
    			foreach ($liste as $key => $val) {
    				$galerie = new Galerie($val);
    		?>
    		<div class="media <?php print($galerie->theme);?>">
			  <a class="media-left pull-left" href="photos.php?galerie=<?php print($galerie->nom);?>">
			    <img height=100 width=100 src="<?php print($galerie->getIcone());?>" alt="<?php print($galerie->titre);?>">
			  </a>
			  <div class="media-body">
			    <h4 class="media-heading">
			    	<a href="photos.php?galerie=<?php print($galerie->nom);?>">
			    		<?php print($galerie->titre);?>
			    	</a>
			    </h4>
			    <p>Date de création : <?php print($galerie->getDateCreation());?></p>
			    <p>Date de dernière modification : <?php print($galerie->getDateModification());?></p>
			    <p>Contenu : <?php print($galerie->getTaille());?> photos</p>
			  </div>
			</div>
    		<?php
    			}
    		?>
    	</div>
    </div>
    </div>
    </body>
</html>