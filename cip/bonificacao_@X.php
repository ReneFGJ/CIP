<?php
/*** Modelo ****/
require("cab_cip.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_bonificacao.php');

	$clx = new bonificacao;
	$tabela = $clx->tabela;
	
	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);

	$http_ver = 'bonificacao_cancelar.php'; 
	$editar = False;
	$http_redirect = page();
	$clx->row();
	$busca = true;
	$offset = 20;
	$pre_where = " bn_status = '@' ";
	if ($order == 0) { $order  = $cdf[3] . ' desc '; }
	echo '<h3>Cancelar o pagamento da bonificação<h3>';
	echo '<font color="#404040">';
	echo '<P>Cancela o pagamento da bonificação. Clique em
			uma das bonificações para seu desmembramento.			
			</P>';	
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 