<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('inicia��o cient�fica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Bolsas</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//////////////////// MANAGERS ///////////////////////////////	
$menu = array();

	array_push($menu,array(msg('Gest�o de bolsas'),'Bolsas implantadas','pibic_rel_bolsa_aluno_implantada.php'));//<--ElizandroLima[@date:06/02/2015] Pagina para o rel_bolsa_aluno_implantada
	array_push($menu,array(msg('Gest�o de bolsas'),'Bolsas implementadas (Seleciona tipo)','pibic_implementacao_bolsas_relatorio.php'));
	array_push($menu,array(msg('Gest�o de bolsas'),'Bolsas suspensas','bolsas_indicacao_status.php'));
	array_push($menu,array(msg('Gest�o de bolsas'),'Resumo de bolsas','bolsas_01.php')); 
	array_push($menu,array(msg('Gest�o de bolsas'),'Substitui��es ou Cancelamentos de bolsas','bolsa_substituicao.php'));
	array_push($menu,array(msg('Gest�o de bolsas'),'Desligados com Orienta��es','docentes_demitidos_com_orientacao.php'));
	//array_push($menu,array('Gest�o de Bolsas','Bolsas Suspensas','rel_rel_01.php'));
	
	
	array_push($menu,array('Bolsas implementadas','Resumo de bolsas',''));
	array_push($menu,array('Bolsas implementadas','__Resumo de bolsas','ic_resumo.php'));
	
	array_push($menu,array('Bolsas implementadas','PIBIC',''));
	array_push($menu,array('Bolsas implementadas','__resumo por Escolas','ic_resumo_escolas.php?dd2=R&dd3=PIBIC&dd5=1&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Detalhe por Escolas','ic_resumo_escolas.php?dd2=D&dd3=PIBIC&dd5=1&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Resumo por Campi','ic_resumo_campi.php?dd2=R&dd3=PIBIC&dd5=1&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Detalhe por Campi','ic_resumo_campi.php?dd2=D&dd3=PIBIC&dd5=1&dd4='.date("Y")));
	
	array_push($menu,array('Bolsas implementadas','PIBITI',''));
	array_push($menu,array('Bolsas implementadas','__Resumo por Escolas','ic_resumo_escolas.php?dd2=R&dd3=PIBITI&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Detalhe por Escolas','ic_resumo_escolas.php?dd2=D&dd3=PIBITI&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Resumo por Campi','ic_resumo_campi.php?dd2=R&dd3=PIBITI&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Detalhe por Escolas','ic_resumo_campi.php?dd2=D&dd3=PIBITI&dd4='.date("Y")));
	
	array_push($menu,array('Bolsas implementadas','PIBIC_EM',''));
	array_push($menu,array('Bolsas implementadas','__Resumo por Escolas','ic_resumo_escolas.php?dd2=R&dd3=PIBICE&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__detalhe por Escolas','ic_resumo_escolas.php?dd2=D&dd3=PIBICE&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Resumo por Campi','ic_resumo_campi.php?dd2=R&dd3=PIBICE&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__detalhe por Escolas','ic_resumo_campi.php?dd2=D&dd3=PIBICE&dd4='.date("Y")));
	
	array_push($menu,array('Bolsas implementadas','CSF',''));
	array_push($menu,array('Bolsas implementadas','__Resumo por Escolas','ic_resumo_escolas.php?dd2=R&dd3=PIBIC&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__detalhe por Escolas','ic_resumo_escolas.php?dd2=D&dd3=PIBIC&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__Resumo por Campi','ic_resumo_campi.php?dd2=R&dd3=PIBIC&dd4='.date("Y")));
	array_push($menu,array('Bolsas implementadas','__detalhe por Escolas','ic_resumo_campi.php?dd2=D&dd3=PIBIC&dd4='.date("Y")));
	
	
	array_push($menu,array(msg('Valida��o de bolsas'),'Alunos com duas bolsas','seleciona_ano.php'));
	

	array_push($menu,array(msg('Bolsas Implementa��o'),'Funda��o Arauc�ria',''));
	array_push($menu,array(msg('Bolsas Implementa��o'),'__ANEXO II','bolsas_anexo_ii.php',''));
	array_push($menu,array(msg('Bolsas Implementa��o'),'__ANEXO IV','bolsas_anexo_iv.php',''));
	
	array_push($menu,array('Implementa��o de Bolsas (Fase de Implementa��o)','Bolsas  (PIBIC) n�o Implementadas','pibic_implementacao_bolsas.php?dd1=PIBIC'));	
	array_push($menu,array('Implementa��o de Bolsas (Fase de Implementa��o)','Bolsas (PIBITI) n�o Implementadas','pibic_implementacao_bolsas.php?dd1=PIBITI'));
	
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

	
	array_push($menu,array('Comit� Gestor','Aprova��o do gestor das pend�ncias de relat�rio parcial','rpc_gestor_aprovacao.php'));	

echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';

require("../foot.php");	
?>