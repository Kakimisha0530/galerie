<?php
include 'classes/utils.php';
include 'classes/writable.php';
include 'classes/galerie.php';
include 'classes/image.php';

$titre = getFormVar ( "galerie" );

if ($titre == null)
	header("location: liste.php");

$galerie = new Galerie ( $titre );

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php displayCss(); ?>
<style>
.carousel-inner > .item > img, .carousel-inner > .item > a > img {
    width: 900px;
    height: 500px;
}
</style>
<title>GALERIE-IMAGES</title>
</head>
<body>
	<div class="container">
		<?php include 'header.php';?>
		<div class='col-sm-12 col-xs-12 row'>
			<button class="back vert_b" title="Retour à la liste" 
			onclick="location.href='liste.php'"></button>
			<h3 align="center"><?php echo strtoupper($galerie->titre); ?></h3>
			<div class='space'></div>
			<div class='galerie'>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
					<?php
					for($i = 0;$i < $galerie->getTaille();$i++){
						print("<li data-target=\"#carousel-example-generic\" data-slide-to=\"$i\"");
						//if($i == 0)print(" class=\"active\"");
						print("></li>\n");
					}
					?>
					</ol>

					<div class="carousel-inner" role="listbox">
					<?php
					for($i = 0;$i < $galerie->getTaille();$i++){
						print("<div class=\"item" . (($i == 0)?" active":"") . "\">\n");
						print("\t<img src=\"photos/" . $galerie->images[$i] . "\" alt=\"" . $galerie->images[$i] . "\">\n");
						print("\t<div class=\"carousel-caption\">...</div>\n");
						print("</div>\n");
					}
					?>
					</div>

					<a class="left carousel-control" href="#carousel-example-generic"
						role="button" data-slide="prev"> <span
						class="glyphicon glyphicon-chevron-left"></span> <span
						class="sr-only">Précédent</span></a>
					<a class="right carousel-control"
						href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span> <span
						class="sr-only">Suivant</span>
					</a>
				</div>
			</div>
			<div class="space"> </div>
			<div class="space"> </div>
			<div class="space"> </div>
		</div>
	</div>
<?php displayJavascript(); ?>
</body>
</html>