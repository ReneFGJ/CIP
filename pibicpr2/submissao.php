<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

//	array_push($menu,array('Submiss�o','Buscar submiss�es','pibic_bolsa_buscar.php')); 
	
	array_push($menu,array('Submiss�o (Fase Geral)','Cockpit','submissao_cockpit.php'));
	 
	array_push($menu,array('Submiss�o (Fase Geral)','Resumo das submiss�es','submissao_resumo.php')); 
	array_push($menu,array('Submiss�o (Fase Geral)','Resumo das submiss�es / centros','submissao_resumo_centro.php')); 
	array_push($menu,array('Submiss�o (Fase Geral)','Resumo das submiss�es / escolas','submissao_resumo_escola.php')); 

	array_push($menu,array('Submiss�o (Fase Geral)','Resumo das submiss�es / Prof. / Escolas / SS','submissao_resumo_professores_ss.php?dd0=S'));  

	array_push($menu,array('Submiss�o (Fase Geral)','Resumo das submiss�es / Projeto do professor','submissao_resumo_professores_pp.php'));
	
	array_push($menu,array('Submiss�o (Fase Geral)','Resumo das submiss�es / Projeto por Campi','submissao_resumo_professores_campi.php'));
	
	array_push($menu,array('Submiss�o (Fase Geral)','Submiss�o por �reas do conhecimento','submissao_resumo_area.php'));
		
	//array_push($menu,array('Submiss�o (Fase Final)','Protocolos/Professor','submissao_projetos_professores_pp.php'));	 
	array_push($menu,array('Submiss�o (Fase Edital)','Protocolos Submiss�o','pibic_projetos.php'));
	
	
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Submiss�o (Fase I)','Agrupar Planos de Alunos (projetos duplicados)','submissao_agrupar_plano.php')); 
	array_push($menu,array('Submiss�o (Fase I)','Submiss�o de projetos','')); 
	array_push($menu,array('Submiss�o (Fase I)','__Projetos submetidos','submissao_projetos.php')); 
	array_push($menu,array('Submiss�o (Fase I)','__Cancelar planos de alunos','submissao_projetos_cancelar.php')); 
	array_push($menu,array('Submiss�o (Fase I)','Aceitar avalia��o (A)','submissao_detalhe.php?dd4='.date("Y").'&dd5=A&dd6=00014')); 
	}


	array_push($menu,array('Avalia��o (Fase II)','Resumo das avalia��es',''));
	array_push($menu,array('Avalia��o (Fase II)','__Projetos de doutorandos','projetos_indicacao.php?dd1=D'));
	array_push($menu,array('Avalia��o (Fase II)','__Projetos com dois planos','projetos_indicacao.php?dd1=2'));
	array_push($menu,array('Avalia��o (Fase II)','__Projetos n�o indicados','projetos_indicacao.php?dd1=B'));

	array_push($menu,array('Avalia��o (Fase II)','__Projetos para o Gestor','projetos_indicacao.php?dd1=U'));
	array_push($menu,array('Avalia��o (Fase II)','__Projetos para a TI','projetos_indicacao.php?dd1=T'));

	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','Resumo das avalia��es','submissao_avaliacao_relatorio.php')); 
	
if ($user_nivel >= 9)
	{	
	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','Planos de alunos sem indica��o','submissao_projetos_sem_aluno.php')); 

	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','Submiss�es em:','')); 
	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','__indicar avaliador (B)','submissao_detalhe.php?dd4='.date("Y").'&dd5=B&dd6=00014'));
	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','__com uma ou menos avalia��es (C)','submissao_detalhe_avaliacao.php?dd4='.date("Y"))); 
	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','__com uma ou menos indica��es (C)','submissao_detalhe_avaliacao_menos.php?dd4='.date("Y"))); 
	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','__avalia��o (C)','submissao_detalhe.php?dd4='.date("Y").'&dd5=C&dd6=00014')); 
	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','__avalia��o realizada (D)','submissao_detalhe.php?dd4='.date("Y").'&dd5=D&dd6=00014')); 
	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','__avalia��o finalizadas (E)','submissao_detalhe.php?dd4='.date("Y").'&dd5=E&dd6=00014')); 

	array_push($menu,array('Submiss�o - Avalia��o (Fase II)','Avalia��es n�o realizadas','submissao_avaliacao_aberta.php')); 

	array_push($menu,array('Submiss�o - Edital (Fase III)','Dados para o edital','pibic_edital_gerar.php')); 
	array_push($menu,array('Submiss�o - Edital (Fase III)','__gerar dados para o edital','pibic_edital_gerar.php')); 
	array_push($menu,array('Submiss�o - Edital (Fase III)','__discrep�ncias das avalia��es','pibic_edital_detalhe.php')); 
	array_push($menu,array('Submiss�o - Edital (Fase III)','Montar Edital (PIBIC)','pibic_edital_3_pibic.php')); 
	array_push($menu,array('Submiss�o - Edital (Fase III)','Montar Edital (PIBITI)','pibic_edital_3_pibiti.php')); 
	}

	array_push($menu,array('Pr�-Edital (Fase Final)','Edital (PIBIC)','pibic_edital_3_pibic.php')); 
	array_push($menu,array('Pr�-Edital (Fase Final)','Edital (PIBIC) - Professores com bolsas','pibic_edital_professores.php')); 

	array_push($menu,array('Edital (Publica��o)','Edital (PIBIC) - Resultado Final','edital.php?dd0=H&dd1=PIBIC&dd2=2012&printer=S')); 
	array_push($menu,array('Edital (Publica��o)','Edital (PIBITI) - Resultado Final','edital_pibiti.php?dd0=H&dd1=PIBITI&dd2=2012&printer=S')); 
	
	array_push($menu,array('Edital (Publica��o)','Edital (PIBIC) - Resultado Final - Bolsa Espec�fica','pibic_edital_especifico.php?dd0=5')); 
	array_push($menu,array('Edital (Publica��o)','Edital (PIBIC) - Resultado Final - Bolsa Espec�fica','pibiti_edital_especifico.php?dd0=5')); 
	array_push($menu,array('Edital (Publica��o','Perfil dos Pesquisadores','edital_perfil.php')); 
	
	array_push($menu,array('Implementa��o de Bolsas (Fase de Implementa��o)','Bolsas n�o Implementadas de Bolsas (PIBIC) ','pibic_implementacao_bolsas.php?dd1=PIBIC')); 
	array_push($menu,array('Implementa��o de Bolsas (Fase de Implementa��o)','Bolsas n�o Implementadas de Bolsas (PIBITI)','pibic_implementacao_bolsas.php?dd1=PIBITI'));
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