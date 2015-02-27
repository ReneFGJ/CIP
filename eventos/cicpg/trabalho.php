<?php
require ("cab.php");
$jid = 85;
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
require("../../_class/_class_autor.php");
$autor = new autor;
require("../../_class/_class_article.php");
$art = new article;

echo '<BR><BR><BR><BR><BR>';

require("../../db_reol2_pucpr.php");

$secu = 'CicPG2014';
if (checkpost($dd[0])==$dd[90])
	{
	$art->le(round($dd[0]));
	} else {
		//echo 'Erro de post 404';
		//exit;
	}

echo '<HR>';
echo '<h3>'.$art->sigla.' - '.$art->line['article_3_keywords'].'</h3><BR>';

echo '<div id="trabalho">';

/* Imagem Tipo */
$mod = $art->line['article_ref'];
$img = 'img/3-poster-grad.png';
$txt = 'Pôster';
if (strpos($mod,'*') > 0)
	{
		$img = 'img/3-oral-grad.png';
		$txt = 'Apresentação Oral';		
	}


echo '<img src="'.$img.'" align="left" title="'.$txt.'">';

if ($_SESSION['editmode']=='1')
	{
		$link = 'http://www2.pucpr.br/reol/editora/article_ed.php?dd0='.$dd[0].'&dd90=98a30f26bb&dd10=view.html';
		$link = '<A HREF="'.$link.'" target="_new">[EDITAR]</A><BR>';
		echo $link;
	}
echo $art->mostrar_artigo();

echo '</div>';
echo '<BR><BR><BR>';
echo '</div>';
/*
 * BBM - Foot Site
 */
require("foot.php");
?>
