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

array_push($menu,array(msg('gestao_de_bolsas'),'Bolsas implantadas','pibic_rel_bolsa_aluno_implantada.php'));//<--ElizandroLima[@date:06/02/2015] Pagina para o rel_bolsa_aluno_implantada
array_push($menu,array(msg('gestao_de_bolsas'),'Resumo de bolsas','bolsas_01.php')); 
array_push($menu,array(msg('gestao_de_bolsas'),'Bolsas implementadas','pibic_implementacao_bolsas_relatorio.php'));
array_push($menu,array(msg('gestao_de_bolsas'),'Bolsas suspensas','bolsas_indicacao_status.php'));
if ($perfil->valid('#ADM') or $perfil->valid >= 9)
	{	
	array_push($menu,array(msg('gestao_de_bolsas'),'Próximas indicações PIBIC','bolsa_proximas_indicacoes.php')); 
	array_push($menu,array(msg('gestao_de_bolsas'),'Próximas indicações PIBITI','bolsa_proximas_indicacoes_pibiti.php'));	 
	}

array_push($menu,array(msg('indicacao_bolsas'),'Indicar Bolsas para Implementação','bolsas_indicacao.php')); 

array_push($menu,array(msg('indicacao_bolsas'),'Status das Bolsas Indicadas','bolsas_indicacao_status.php'));


if ($perfil->valid('#ADM')) 
	{
		array_push($menu,array(msg('ativar_bolsas'),'Ativar um protocolo de pesquisa com ICV','bolsa_ativar_icv.php'));		
	}

array_push($menu,array('Fundação Araucária - Bolsas Implementação','ANEXO II','bolsas_anexo_ii.php'));
array_push($menu,array('Fundação Araucária - Bolsas Implementação','ANEXO IV','bolsas_anexo_iv.php'));

echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';
require("../foot.php");	
?>