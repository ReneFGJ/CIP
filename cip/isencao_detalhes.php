<?php
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

if (strlen($dd[0]) > 0)
	{
	$rlt = $bon->indentifica_isencao($dd[0]);
	echo $bon->isencao_proj_mostra_F($rlt);
	} else {
		echo 'Paramentros não informado';
	}

require("../foot.php");
?>
