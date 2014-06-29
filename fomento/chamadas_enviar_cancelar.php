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
	
	echo '<A HREF="index.php" class="submit-geral">VOLTAR</A>';
	
	$saldo = $clx->cancelar_email();
	echo '-->'.$saldo;
	
	echo '<H3>Cancelado com sucesso</h3>';
	
require("../foot.php");		
?> 