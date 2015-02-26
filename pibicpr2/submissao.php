<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

//	array_push($menu,array('Submissão','Buscar submissões','pibic_bolsa_buscar.php')); 
	
	array_push($menu,array('Submissão (Fase Geral)','Cockpit','submissao_cockpit.php'));
	 
	array_push($menu,array('Submissão (Fase Geral)','Resumo das submissões','submissao_resumo.php')); 
	array_push($menu,array('Submissão (Fase Geral)','Resumo das submissões / centros','submissao_resumo_centro.php')); 
	array_push($menu,array('Submissão (Fase Geral)','Resumo das submissões / escolas','submissao_resumo_escola.php')); 

	array_push($menu,array('Submissão (Fase Geral)','Resumo das submissões / Prof. / Escolas / SS','submissao_resumo_professores_ss.php?dd0=S'));  

	array_push($menu,array('Submissão (Fase Geral)','Resumo das submissões / Projeto do professor','submissao_resumo_professores_pp.php'));
	
	array_push($menu,array('Submissão (Fase Geral)','Resumo das submissões / Projeto por Campi','submissao_resumo_professores_campi.php'));
	
	array_push($menu,array('Submissão (Fase Geral)','Submissão por áreas do conhecimento','submissao_resumo_area.php'));
		
	//array_push($menu,array('Submissão (Fase Final)','Protocolos/Professor','submissao_projetos_professores_pp.php'));	 
	array_push($menu,array('Submissão (Fase Edital)','Protocolos Submissão','pibic_projetos.php'));
	
	
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Submissão (Fase I)','Agrupar Planos de Alunos (projetos duplicados)','submissao_agrupar_plano.php')); 
	array_push($menu,array('Submissão (Fase I)','Submissão de projetos','')); 
	array_push($menu,array('Submissão (Fase I)','__Projetos submetidos','submissao_projetos.php')); 
	array_push($menu,array('Submissão (Fase I)','__Cancelar planos de alunos','submissao_projetos_cancelar.php')); 
	array_push($menu,array('Submissão (Fase I)','Aceitar avaliação (A)','submissao_detalhe.php?dd4='.date("Y").'&dd5=A&dd6=00014')); 
	}


	array_push($menu,array('Avaliação (Fase II)','Resumo das avaliações',''));
	array_push($menu,array('Avaliação (Fase II)','__Projetos de doutorandos','projetos_indicacao.php?dd1=D'));
	array_push($menu,array('Avaliação (Fase II)','__Projetos com dois planos','projetos_indicacao.php?dd1=2'));
	array_push($menu,array('Avaliação (Fase II)','__Projetos não indicados','projetos_indicacao.php?dd1=B'));

	array_push($menu,array('Avaliação (Fase II)','__Projetos para o Gestor','projetos_indicacao.php?dd1=U'));
	array_push($menu,array('Avaliação (Fase II)','__Projetos para a TI','projetos_indicacao.php?dd1=T'));

	array_push($menu,array('Submissão - Avaliação (Fase II)','Resumo das avaliações','submissao_avaliacao_relatorio.php')); 
	
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Submissão - Avaliação (Fase II)','Planos de alunos sem indicação','submissao_projetos_sem_aluno.php')); 

	array_push($menu,array('Submissão - Avaliação (Fase II)','Submissões em:','')); 
	array_push($menu,array('Submissão - Avaliação (Fase II)','__indicar avaliador (B)','submissao_detalhe.php?dd4='.date("Y").'&dd5=B&dd6=00014'));
	array_push($menu,array('Submissão - Avaliação (Fase II)','__com uma ou menos avaliações (C)','submissao_detalhe_avaliacao.php?dd4='.date("Y"))); 
	array_push($menu,array('Submissão - Avaliação (Fase II)','__com uma ou menos indicações (C)','submissao_detalhe_avaliacao_menos.php?dd4='.date("Y"))); 
	array_push($menu,array('Submissão - Avaliação (Fase II)','__avaliação (C)','submissao_detalhe.php?dd4='.date("Y").'&dd5=C&dd6=00014')); 
	array_push($menu,array('Submissão - Avaliação (Fase II)','__avaliação realizada (D)','submissao_detalhe.php?dd4='.date("Y").'&dd5=D&dd6=00014')); 
	array_push($menu,array('Submissão - Avaliação (Fase II)','__avaliação finalizadas (E)','submissao_detalhe.php?dd4='.date("Y").'&dd5=E&dd6=00014')); 

	array_push($menu,array('Submissão - Avaliação (Fase II)','Avaliações não realizadas','submissao_avaliacao_aberta.php')); 

	array_push($menu,array('Submissão - Edital (Fase III)','Dados para o edital','pibic_edital_gerar.php')); 
	array_push($menu,array('Submissão - Edital (Fase III)','__gerar dados para o edital','pibic_edital_gerar.php')); 
	array_push($menu,array('Submissão - Edital (Fase III)','__discrepâncias das avaliações','pibic_edital_detalhe.php')); 
	array_push($menu,array('Submissão - Edital (Fase III)','Montar Edital (PIBIC)','pibic_edital_3_pibic.php')); 
	array_push($menu,array('Submissão - Edital (Fase III)','Montar Edital (PIBITI)','pibic_edital_3_pibiti.php')); 
	}

	array_push($menu,array('Pré-Edital (Fase Final)','Edital (PIBIC)','pibic_edital_3_pibic.php')); 
	array_push($menu,array('Pré-Edital (Fase Final)','Edital (PIBIC) - Professores com bolsas','pibic_edital_professores.php')); 

	array_push($menu,array('Edital (Publicação)','Edital (PIBIC) - Resultado Final','edital.php?dd0=H&dd1=PIBIC&dd2=2012&printer=S')); 
	array_push($menu,array('Edital (Publicação)','Edital (PIBITI) - Resultado Final','edital_pibiti.php?dd0=H&dd1=PIBITI&dd2=2012&printer=S')); 
	
	array_push($menu,array('Edital (Publicação)','Edital (PIBIC) - Resultado Final - Bolsa Específica','pibic_edital_especifico.php?dd0=5')); 
	array_push($menu,array('Edital (Publicação)','Edital (PIBIC) - Resultado Final - Bolsa Específica','pibiti_edital_especifico.php?dd0=5')); 
	array_push($menu,array('Edital (Publicação','Perfil dos Pesquisadores','edital_perfil.php')); 
	
	array_push($menu,array('Implementação de Bolsas (Fase de Implementação)','Bolsas não Implementadas de Bolsas (PIBIC) ','pibic_implementacao_bolsas.php?dd1=PIBIC')); 
	array_push($menu,array('Implementação de Bolsas (Fase de Implementação)','Bolsas não Implementadas de Bolsas (PIBITI)','pibic_implementacao_bolsas.php?dd1=PIBITI'));
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