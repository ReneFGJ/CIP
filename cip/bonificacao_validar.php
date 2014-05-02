<?php
require("cab.php");

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$bon->le($dd[0]);

echo '<center><font class="lt3">';
if ($bon->status == '@')
	{
		$bon->historico_inserir($bon->protocolo,'VLD','Validado por '.$user->user_login);
		$bon->troca_status('@','A');
		echo 'VALIDADO COM SUCESSO!';	
	} else {
		echo 'Protocolo não habilidado para validação';
	}
	echo '<form action="bonificacao_@.php"><center>';
	echo '<input type="submit" value="voltar">';
	echo '</form>';	


?>
