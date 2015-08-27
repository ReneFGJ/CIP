<?php
require("db.php");
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

/* 
 * BBM - Header Site 
 */
echo $site->header_site();

echo '<HR>';
echo $site->abre_secao($art->modalidade);
echo '<h1>'.$art->sigla.'</h1><BR>';

$text = $art->mostrar_artigo();

if ($dd[99]=='1')
	{
	$sql = "update articles set article_dt_revisao = ".date("Ymd")." where id_article = ".round($dd[0]);
	$rlt = db_query($sql);

	echo '<h1><center><font color="green">Artigo Validado com sucesso!</font></center></h1><BR><BR>';
	require('../_class/_class_ic.php');
	$journal_id = 67;
	$ic = new ic;
	$txt = $ic->ic('SEMIC_VALIDED');
	
	
	//$text = $txt['nw_descricao'].'<BR><BR>'.$text;
	//$titulo = $txt['nw_titulo'];
	}


echo $text;
echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
