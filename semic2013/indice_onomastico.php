<?php
require("db.php");
/*
 * Incluir Classes para a página
 */
require("_class/_class_semic_layout.php");
$site = new layout;

/* 
 * BBM - Header Site 
 */
echo $site->header_site();

echo $site->banner_vermelho();


if($LANG == 'pt_BR')
	{
	echo $site->abre_secao('Índice');
	$file = 'indice_onomastico_pt.php';
	} else {
	echo $site->abre_secao('Index');
	$file = 'indice_onomastico_en.php';	
	}
//require($file);

echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
