<?
    /**
     * Gerenciar Relatórios
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

	array_push($menu,array('Bolsas','Bolsas PIBIC_<font color="orange">EM</font> (2012)','rel_bolsa_aluno.php?dd0=H&dd1=&dd2=2012'));
	array_push($menu,array('Bolsas','Bolsas PIBIC_<font color="orange">EM</font> (2011)','rel_bolsa_aluno.php?dd0=J&dd1=&dd2=2011')); 

//	array_push($menu,array('Bolsas','Ativar ICV','bolsa_ativar_icv.php')); 
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Bolsas','Bolsas Duplicadas','bolsa_duplicadas.php')); 

	array_push($menu,array('Bolsas','Acompanhamento','')); 	
	array_push($menu,array('Bolsas','__Substituíção','rel_bolsa_acao_substituicao.php')); 	
	array_push($menu,array('Bolsas','__Cancelamento','rel_bolsa_acao_cancelado.php')); 	
	array_push($menu,array('Bolsas','__Troca de modalidade','rel_bolsa_acao_troca.php')); 	
	
	array_push($menu,array('Relatório','Bolsas/Curso/Aluno','rel_bolsa_aluno.php')); 
	array_push($menu,array('Relatório','Curso/Aluno (resumo)','rel_curso_resumo.php')); 
	array_push($menu,array('Relatório','Bolsas Implementadas (Resumo)','rel_bolsa_aluno_implantada.php')); 
	}
	

if ($user_nivel >= 9)
	{	
	array_push($menu,array('Relatórios Financeiro','Bolsas implementadas','rel_financeiro_bolsas_pagas.php')); 
	}
	
if ($user_nivel >= 9)
	{		
	array_push($menu,array('Relatórios Estratégicos','Bolsas implementadas','')); 
	array_push($menu,array('Relatórios Estratégicos','__Centro/Curso/Aluno','rel_bolsa_0001.php')); 
	array_push($menu,array('Relatórios Estratégicos','__Centro/Professor/Aluno','rel_bolsa_0002.php')); 

	array_push($menu,array('Relatórios Estratégicos','__Centro/Curso/Aluno (implementados)','rel_bolsa_0003.php')); 
	array_push($menu,array('Relatórios Estratégicos','__Trabalhos por Àrea/Centro','rel_relatorio_numero_trabalhos_por_area.php')); 
	array_push($menu,array('Relatórios Estratégicos','__Professores Strictus','rel_professores_tipo_1.php')); 
	}
	
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Acompanhamento','Relatórios parcial','rel_bolsa_relatorio_parcial.php')); 
	array_push($menu,array('Acompanhamento','Relatórios final','rel_bolsa_relatorio_final.php')); 
	array_push($menu,array('Acompanhamento','Relatórios resumo','rel_bolsa_relatorio_resumo.php'));
	array_push($menu,array('Acompanhamento','Resumo para publicação','rel_bolsa_relatorio_resumo_publicacao.php'));
	array_push($menu,array('Acompanhamento','e-mail de aviso (orientadores)','rel_bolsa_envio_email.php'));
	array_push($menu,array('Acompanhamento','e-mail de aviso (avaliadores)','rel_bolsa_envio_email_avaliador_local.php'));
	
	array_push($menu,array('Gestão de pessoas','e-mail professores','rel_bolsa_email_professores.php'));
	array_push($menu,array('Gestão de pessoas','e-mail alunos',		'rel_bolsa_email_alunos.php'));
	}

	array_push($menu,array('Pareceristas','Pareceristas','')); 
	array_push($menu,array('Pareceristas','__Resumo','paraceristas_rel_resumo.php')); 
	array_push($menu,array('Pareceristas','__Cadastro','ed_pareceristas.php')); 
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Relatório','Relatório estratégico - diacrônico',		'graph_diacronico.php'));
	}
	
array_push($menu,array('Docentes','Docentes',''));
array_push($menu,array('Docentes','Corpo Docente: capacidade de orientação na área tecnológica','rel_docente_tipo_01.php'));	
	
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