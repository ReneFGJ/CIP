<?
require("cab_fomento.php");
require('../_class/_class_fomento.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_email.php');

	$clx = new fomento;
	$clx->le($dd[0]);
	
	echo '<A HREF="chamadas.php" class="submit-geral">VOLTAR</A>';
	
	$saldo = $clx->enviar_email(100);
	echo '-->'.$saldo;
	
	if ($saldo > 0)
		{
			echo '<meta http-equiv="refresh" content="1;'.$http.'fomento/chamadas_enviar_email.php">';
		} else {
			echo '<h3>Fim do Envio</h3>';
		}
require("../foot.php");		
?> 