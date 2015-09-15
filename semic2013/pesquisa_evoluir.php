<?php
require("db.php");
 
 /*
 * Incluir Classes para a página
 */
require("_class/_class_semic_layout.php");
$site = new layout;
require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

/* 
 * BB - Header Site 
 */
echo $site->header_site();

/*
 * BBM - Foot Site
 */
if ($LANG == 'en')
	{
		echo $site->abre_secao('Summary');
	} else {
		echo $site->abre_secao('Espaço "Pesquisar é Evoluir"');		
	}


//echo $semic->sumario_geral();
/*
 * echo $semic->lista_de_trabalhos();
 */

 $tp = '';
 if ($LANG == 'en') { $tp = '_en'; }
 
 echo '<A NAME="EVO"><A>';
 require("sumario_20".$tp.".php");

echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
