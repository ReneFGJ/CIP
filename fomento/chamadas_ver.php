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
	
	echo $clx->mostra();
	
	
	echo '<form action="chamadas_enviar.php">';
	echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	echo '<input type="hidden" name="dd1" value="1">';
	echo '<input type="submit" name="dd5" value="enviar comunicação de chamada" class="submit-geral">';
	echo '</form>';
	
	echo $clx->lidos();
	
	
	echo '<form>';
	echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	echo '<input type="hidden" name="dd1" value="1">';
	echo '<input type="submit" name="acao" value="enviar teste" class="submit-geral">';
	echo '</form>';
	
	if ((strlen($acao) > 0) and ($dd[1] == '1'))
		{
			$email = 'pdi@pucpr.br';
			enviaremail($email,'',$clx->titulo,$clx->texto);
			echo 'Enviado para '.$email;
		}

	require("../_class/_class_produto_categoria.php");
	$fmt = new categoria;
	echo $fmt->form_categoria($clx->id);
	
	
require("../foot.php");		
?> 