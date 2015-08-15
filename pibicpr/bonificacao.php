<?php
/*** Modelo ****/
require ("cab.php");
global $acao, $dd, $cp, $tabela;
require ($include . 'sisdoc_colunas.php');
require ($include . 'sisdoc_data.php');
require ($include . 'sisdoc_form2.php');
require ($include . 'sisdoc_debug.php');

/* Dados da Classe */
require ('../_class/_class_bonificacao.php');

if (($perfil -> valid('#ADM#SCR#COO#SPG'))) {
	$clx = new bonificacao;
	$tabela = $clx -> tabela;

	//$sql = "update ".$tabela." set bn_status = 'A' where bn_status = '#' ";
	//$rlt = db_query($sql);

	/* Mensagens */
	$link_msg = '../messages/msg_' . page();
	if (file_exists($link_msg)) {
		require ($link_msg);
	}

	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = 'bonificacao_ed.php';
	$http_ver = 'bonificacao_detalhe.php';
	$editar = False;
	$http_redirect = $tabela . '.php';
	$clx -> row();
	$busca = true;
	$offset = 20;

	if ($order == 0) { $order = $cdf[3] . ' desc ';
	}

	echo '<TABLE width="' . $tab_max . '" align="center"><TR><TD>';
	require ($include . 'sisdoc_row.php');
	echo '</table>';
}
require ("../foot.php");
?>
