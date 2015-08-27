<?php
require("cab.php");
echo '
<div id="conteudo" style="margin:0 auto -330px;">
';

require("_class/_class_avaliador_relatorio.php");
$avc = new avaliador_relatorio;

$nome = $dd[1];

		echo '
		Buscar avaliadores<BR>
		<form method="get" action="avaliadores.php">
			<input type="string" name="dd1" size="60">
			<input type="submit" name="acao" value="busca">
		</form>		
		';
		echo '<HR>';
		
if (strlen($nome) > 0)
	{
		echo '<div id="cab_top">Lista de Avaliadores</div>';
		echo $avc->lista_avaliadores($nome);
	} else {

		
		
	}
require("foot.php");
?>


