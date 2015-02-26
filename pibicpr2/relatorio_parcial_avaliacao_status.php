<?php
require("cab.php");

require('../_class/_class_parecer.php');
$par = new parecer;

echo '<center>Resumo das avaliações';
echo $par->resumo_avaliacao();

echo '<center>Resumo do acesso';
echo $par->resumo_avaliacao_leitura();


if (($user->user_nivel >= 9) or ($user_nivel >= 9))
	{
		if (strlen($dd[1])==0)
		{
			echo '<table class="lt1"><TR>';
			echo '<TD><form method="post" action="'.page().'">';
			echo '<TD><input type="checkbox" name="dd1" value=1><nobr>Cancelar todas as indicações não avaliadas.';
			echo '<TD><input type="submit" value="cancelar >>"';
			echo '<TD></form>';
		} else {
			echo '<BR<BR><font color="green">Todos as indicações de relatório parcial foram canceladas</font>';
			$par->cancelar_avaliacoes_idicadas(date("Y").'P');
		}
	}
?>
