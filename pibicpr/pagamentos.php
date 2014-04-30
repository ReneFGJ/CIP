<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array(msg('pagamentos'),'Razão de pagamentos mensal','pagamentos_01.php'));
array_push($menu,array(msg('pagamentos'),'Lista de pagamentos por período','pagamentos_05.php'));
array_push($menu,array(msg('pagamentos'),'Razão de pagamentos aluno por período','pagamentos_02.php'));

array_push($menu,array(msg('pagamentos'),'Alunos da IC e benefício','pagamentos_03.php')); 
array_push($menu,array(msg('pagamentos'),'Alunos com IC em duplicidade','pagamentos_04.php'));

if (($perfil->valid('#ADM#SCR#COO#SPI')))
	{
	array_push($menu,array(msg('gerar_pagamentos'),'Gerar Planilha de Pagamento','pagamentos_06.php')); 
	array_push($menu,array(msg('gerar_pagamentos'),'__'.'Gerar Planilha de Pagamento'.'(não efetivados)','pagamentos_09.php')); 
	array_push($menu,array(msg('gerar_pagamentos'),'Extornar valores não processados','pagamentos_07.php'));
	array_push($menu,array(msg('gerar_pagamentos'),'Gerar pagamentos por BO','pagamentos_08B.php'));
	array_push($menu,array(msg('gerar_pagamentos'),'__Cancelar pagamentos por BO','pagamentos_08C.php'));
	array_push($menu,array(msg('gerar_pagamentos'),'Reprocessar valores extornados','pagamentos_08.php'));
	array_push($menu,array(msg('gerar_pagamentos'),'__gerar arquivos para o Banco','pagamentos_08A.php')); 
	}
array_push($menu,array(msg('espelho_pagamentos'),'Visualizar','pibic_espelho_resumo.php'));
array_push($menu,array(msg('espelho_pagamentos'),'Visualizar ??','pibic_espelho.php'));

array_push($menu,array(msg('espelho_pagamentos'),'Processar Dados','pibic_espelho_processar.php'));
array_push($menu,array(msg('espelho_pagamentos'),'Processar Complementos','pibic_espelho_processar_complemento.php'));

array_push($menu,array(msg('auditoria'),'Auditoria','auditoria_relatorio_01.php'));

echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';
require("../foot.php");	
?>