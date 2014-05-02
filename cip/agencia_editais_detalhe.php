<?php
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');

	/* Dados da Classe */
	require('../_class/_class_agencia_editais.php');

	$clx = new agencia_editais;
	$tabela = $clx->tabela;

	echo $clx->mostra_edital_detalhe($dd[0]);
	
	echo $clx->mostra_demandas();
	
	$link = '<A HREF="javascript:newxy2(\'agencia_editais_fomentos_popup.php?dd1='.$dd[0].'\',700,600);">[nova solicação]</A>';
	echo $link;
 
?>
<form method="get" action="agencia_editais_detalhe_email.php">
	<input type="submit" value="Enviar e-mail para pesquisadores" style="width: 300px; height: 50px;">
	<input type="hidden" value="<?php echo $dd[0];?>" name="dd0">
</form>
<?
	
require("../foot.php");		
?> 