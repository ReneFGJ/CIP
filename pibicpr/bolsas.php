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

array_push($menu,array(msg('Gest�o de bolsas'),'Bolsas implantadas','pibic_rel_bolsa_aluno_implantada.php'));//<--ElizandroLima[@date:06/02/2015] Pagina para o rel_bolsa_aluno_implantada
array_push($menu,array(msg('Gest�o de bolsas'),'Bolsas implementadas','pibic_implementacao_bolsas_relatorio.php'));
array_push($menu,array(msg('Gest�o de bolsas'),'Bolsas suspensas','bolsas_indicacao_status.php'));
array_push($menu,array(msg('Gest�o de bolsas'),'Resumo de bolsas','bolsas_01.php')); 

array_push($menu,array(msg('Indicacao de bolsas'),'Indicar Bolsas para Implementa��o','bolsas_indicacao.php')); 
array_push($menu,array(msg('Indicacao de bolsas'),'Status das Bolsas Indicadas','bolsas_indicacao_status.php'));
if ($perfil->valid('#ADM') or $perfil->valid >= 9)
	{	
	array_push($menu,array(msg('Indicacao de bolsas'),'Pr�ximas indica��es PIBIC','bolsa_proximas_indicacoes.php')); 
	array_push($menu,array(msg('Indicacao de bolsas'),'Pr�ximas indica��es PIBITI','bolsa_proximas_indicacoes_pibiti.php'));	 
	}

if ($perfil->valid('#ADM')) 
	{
		array_push($menu,array(msg('Ativar bolsas'),'Ativar um protocolo de pesquisa com ICV','bolsa_ativar_icv.php'));		
	}

array_push($menu,array(msg('Bolsas Implementa��o'),'Funda��o Arauc�ria',''));
array_push($menu,array(msg('Bolsas Implementa��o'),'__ANEXO II','bolsas_anexo_ii.php',''));
array_push($menu,array(msg('Bolsas Implementa��o'),'__ANEXO IV','bolsas_anexo_iv.php',''));


array_push($menu,array(msg('Valida��o de bolsas'),'Alunos com duas bolsas','seleciona_ano.php'));

echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';



require("../foot.php");	
?>