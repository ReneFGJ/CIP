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

echo $site->abre_secao('Programação');

//require("_content_programacao_06.php");
//require("_content_programacao_07.php");
//require("_content_programacao_08.php");

echo '
<style>

.mini22 td {
		font-size: 11px;
		background-color: #DDFFFF;	 
	}
.mini23 td {
		font-size: 11px;
		background-color: #FFFFDD;	 
	}
.mini24 td {
		font-size: 11px;
		background-color: #FFDDFF;	 
	}
.mini_hd td
	{
		font-size: 9px;
		background-color: #F0F0F0;
	}
.mini_hr td
	{
		font-size: 14px;
		background-color: #B0B0B0;
	}	
.mini_ab td
	{
		font-size: 19px;
		background-color: #11F0F0;
	}
.mini_ab
	{
		font-size: 19px;
		background-color: #11F0F0;
	}	
</style>
';

require("_content_programacao.php");
//require("_content_normas.php");

require("semic_programacao.php");

echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
