<?php
require ("cab.php");
require ($include . 'sisdoc_email.php');
require ($include . 'sisdoc_debug.php');
require ($include . '_class_form.php');
require ("realce.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs, array(http . 'admin/index.php', msg('principal')));
array_push($breadcrumbs, array(http . 'admin/index.php', msg('menu')));
echo '<div id="breadcrumbs">' . breadcrumbs() . '</div>';

require ("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require ("../_class/_class_pibic_mirror.php");
$mr = new mirror;

require ("../_class/_class_pibic_historico.php");
$ph = new pibic_historico;

require ("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;

require ("../_class/_class_pibic_pagamento.php");
$pg = new pagamentos;
$pg -> processar_mes_ano();
$idx = $dd[0];
if (strlen($idx) == 7) { $id = 0;
	$proto = $dd[0];
} else { $id = $dd[1];
	$proto = 'xxxx';
}

/* tamanho */
echo '<div width: 95%" id="conteudo" style="border: 0px #FFFFFF solid">';

$pb -> le($id, $proto);
echo $pb -> mostar_dados();
$proto = $pb -> pb_protocolo;

require ("../pibic/_ged_config.php");
echo '<fieldset><legend class="lt3">Arquivos</legend>';

$ged -> protocol = trim($pb -> pb_protocolo_mae);
$tela = $ged -> filelist();
if ($ged -> total_file > 0) { echo $tela;
}

if ($_GET['ddg'] == 'DEL')
	{
		$ged->file_delete();
	}

$ged -> protocol = $proto;
echo $ged -> file_list();

if (($perfil -> valid('#ADM') == 1) or ($perfil -> valid('#PIB#PIT#SPI') == 1)) {
	echo $ged->upload_botton();
	

} else {
	echo $ged -> filelist();
}

echo '</fieldset>';

echo $pp -> avaliadores($proto);
echo '<HR>';
//echo $mr->mostra_espelho($proto);
//echo '<HR>';
echo '<fieldset><legend class="lt4">Histórico</legend>';
echo $ph -> mostra_historico($proto);
echo '</fieldset>';

//echo $pb -> acoes();
echo '<BR><BR><BR>';
echo '</div>'; // Fecha conteúdo
require ("../foot.php");
?>