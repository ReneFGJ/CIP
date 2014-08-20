<?php
require("cab_cnpq.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_debug.php');

require("realce.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_pibic_mirror.php");
$mr = new mirror;

require("../_class/_class_pibic_historico.php");
$ph = new pibic_historico;

require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;

require("../_class/_class_pibic_pagamento.php");
$pg = new pagamentos;
$pg->processar_mes_ano();
$idx = $dd[0];
if (strlen($idx)==7)
	{ $id = 0; $proto = $dd[0]; }
else
	{ $id = $dd[1]; $proto = 'xxxx'; }
	
$pb->le($id,$proto);
echo $pb->mostar_dados();
$proto = $pb->pb_protocolo;

require("../pibic/_ged_config.php");
echo '<fieldset><legend>Arquivos</legend>';
$ged->protocol = $proto;
echo $ged->filelist();
echo '</fieldset>';

//echo $pp->avaliadores($proto);
//echo '<HR>';
echo '<table class="tabela00">';
echo $ph->mostra_historico($proto);
echo '</table>';

//echo $pb->acoes();

require("../foot.php");	
?>