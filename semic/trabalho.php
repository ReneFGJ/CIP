<?php
require ("cab.php");
?>

<header>
	<img src="img/bk_topo_pt1.png" />
</header>

<div class="text-full">
	
<?php
require($include."sisdoc_autor.php");
/*
 * Incluir Classes para a página
 */
require("_class/_class_semic_layout.php");
$site = new layout;
require("../_class/_class_autor.php");
$autor = new autor;
require("../_class/_class_article.php");
$art = new article;

if (checkpost($dd[0])==$dd[90])
	{
	$art->le(round($dd[0]));
	
	}

echo '<HR>';
echo $site->abre_secao($art->modalidade);
echo '<h3>'.$art->sigla.'</h3><BR>';

echo $art->mostrar_artigo();

echo $site->fecha_secao();

echo '</div>';
/*
 * BBM - Foot Site
 */
require("foot.php");
?>
