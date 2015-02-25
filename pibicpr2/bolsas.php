<?
    /**
     * Gerenciar Bolsas
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011, PUCPR
	 * @access public
     * @version v0.11.30;
	 * @link http://www2.pucpr.br/reol2/
	 * @package Menus
	 * @subpackage Geral
     */
	 
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Bolsas','Buscar bolsas','pibic_bolsa_buscar.php')); 
	array_push($menu,array('Bolsas','Bolsas','ed_pibic_bolsas_contempladas.php')); 

if ($user_nivel >= 9)
	{
	array_push($menu,array('Bolsas','Acompanhamento','')); 	
	array_push($menu,array('Bolsas','__Substituíção','rel_bolsa_acao_substituicao.php')); 	
	array_push($menu,array('Bolsas','__Cancelamento','rel_bolsa_acao_cancelado.php')); 	
	array_push($menu,array('Bolsas','Gestão de Bolsas','')); 	
	array_push($menu,array('Bolsas','__Bolsas Duplicadas','rel_bolsa_duplicadas.php')); 	
	}
//	array_push($menu,array('Bolsas','Bolsas Duplicadas','bolsa_duplicadas.php')); 

	array_push($menu,array('Relatório','Bolsas Implementadas (Resumo)','rel_bolsa_aluno_implantada.php')); 
if ($user_nivel >= 9)
	{
	array_push($menu,array('Relatório','Bolsas/Curso/Aluno','rel_bolsa_aluno.php')); 
	array_push($menu,array('Relatório','Relatório bolsa/centros','rel_bolsa_relatorio_centros.php')); 
	array_push($menu,array('Relatório','Relatório bolsa/centros e cursos','rel_bolsa_relatorio_centros_cursos.php')); 
	array_push($menu,array('Relatório','Relatório bolsa/centros, cursos e bolsas','rel_bolsa_relatorio_centros_cursos_bolsas.php')); 
	array_push($menu,array('Relatório','Relatório Trabalhos por Àrea/Centro','rel_relatorio_numero_trabalhos_por_area.php')); 

	array_push($menu,array('Relatório - Professor','Bolsas/Centro/Professor','rel_bolsa_relatorio_centros_professor.php')); 

	array_push($menu,array('Relatórios','Modalidade de Bolsa (exportação Excel)','pibic_bolsas_tipo_excel.php')); 

	
	array_push($menu,array('Relatórios parcial','Relatios parcial','bolsa_relatorio_parcial.php')); 

	array_push($menu,array('Relatórios parcial','Avaliação do Relatios parcial','relatorio_parcial_avaliacao_status.php')); 
	array_push($menu,array('Relatórios parcial','__e-mail de aviso','bolsa_relatorio_parcial_email.php')); 
	array_push($menu,array('Relatórios parcial','__entregues, sem indicação de avaliador','rel_bolsa_envio_email_avaliador_sem.php')); 
	array_push($menu,array('Relatórios parcial','__entregues, indicados e não avaliado (e-mail)','rel_bolsa_envio_email_avaliador_local.php')); 

	array_push($menu,array('Relatórios parcial','Comunicar professores (resultado avaliação)','rel_rp_avaliacao_enviar_professor.php')); 
	array_push($menu,array('Relatórios parcial','Liberar relatórios pendentes','rp_liberar_pendentes.php')); 
	}

if ($user_nivel >= 9)
	{
		
	array_push($menu,array('Relatórios final','Avaliação do Relatios final','relatorio_parcial_avaliacao_status.php')); 
	//array_push($menu,array('Relatórios final','__e-mail de aviso','bolsa_relatorio_parcial_email.php')); 
	array_push($menu,array('Relatórios final','__entregues, sem indicação de avaliador','rel_bolsa_envio_email_avaliador_sem_rf.php')); 

	array_push($menu,array('Acompanhamento','Relatórios final','bolsa_relatorio_final.php')); 
	array_push($menu,array('Acompanhamento','__Relatórios final (indicar avaliadores)','bolsa_relatorio_final_indicar.php')); 
	
	array_push($menu,array('Acompanhamento','Relatórios resumo','rel_bolsa_relatorio_resumo.php'));
	array_push($menu,array('Acompanhamento','Resumo para publicação','rel_bolsa_relatorio_resumo_publicacao.php'));

	array_push($menu,array('Gestão de pessoas','Professores','')); 
	array_push($menu,array('Gestão de pessoas','__e-mail dos professores (todos ativos)',	'comunicacao_email_professores.php?dd3=9999')); 
	array_push($menu,array('Gestão de pessoas','__e-mail dos professores (por bolsas ativas)',	'comunicacao_email_professores.php')); 

	array_push($menu,array('Gestão de pessoas','Estudantes','')); 
	array_push($menu,array('Gestão de pessoas','__e-mail dos estudantes (todos ativos)',	'comunicacao_email_estudantes.php?dd3=9999')); 
	array_push($menu,array('Gestão de pessoas','__e-mail dos estudantes (por bolsas ativas)',	'comunicacao_email_estudantes.php')); 
	}
	
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Gestão de bolsa','Próximas indicações PIBIC','bolsa_proximas_indicacoes.php')); 
	array_push($menu,array('Gestão de bolsa','Próximas indicações PIBITI','bolsa_proximas_indicacoes_pibiti.php'));	 
	}
///////////////////////////////////////////////////// redirecionamento

?>
<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="bolsa.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?
menus($menu,'3');
?>
</TABLE>
<? require("foot.php");	?>