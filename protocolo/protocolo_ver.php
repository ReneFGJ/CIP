<?php
require ("cab.php");
require ("../_class/_class_protocolo.php");
require('../_include/sisdoc_debug.php');

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$LANG = 'pt_BR';
require ($include . 'sisdoc_email.php');

require ($include . '_class_form.php');
$form = new form;
require ("_form_css.php");

$pr = new protocolo;

if (checkpost($dd[0]) != $dd[1]) {
	echo 'Erro de post';
	exit ;
}
$pr -> le($dd[0]);
$sta = trim($pr -> line['pr_status']);

echo $pr -> mostra();
$proto = $pr->line['pr_protocolo_original'];
$pb->le('',$proto);

echo $pb -> mostar_dados();

$tipo = $pr -> tipo;
if ($sta == '@') 
	{

	$arq = "protocolo_acao_" . $tipo . '.php';
	if (file_exists($arq)) {
		require ($arq);
	} else {
		echo '<h3><font color="red">Ação não existente (' . $tipo . ')</font></h3>';
	}
} else {
	switch ($sta) {
		case 'F' :
			echo '<h3>Protocolo já encerrado</h3>';
			break;
		case 'C' :
			echo '<h3>Protocolo cancelado</h3>';
			break;
	}
	echo '<table class="tabela00 lt2" width="100%">
			<TR><TD colspan=2>';	
	echo '<fieldset><legend class="tabela00">Solução</legend>';
	echo $pr->line['pr_solucao'];
	echo '</fieldset>';
	
	echo '<TR>	<TD>Data finalização: '.stodbr($pr->line['pr_solucao_data']).'
				'.$pr->line['pr_solucao_hora'].'
		  <TR>  <TD>
				'.$pr->line['pr_solucao_log'];
	echo '</table>';
}
require ('../foot.php');
?>