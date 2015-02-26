<?php
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Pesquisadores/Professores','Professores','')); 
	array_push($menu,array('Pesquisadores/Professores','__Cadastro','docentes.php')); 
	
	array_push($menu,array('Estudantes','Estudantes','')); 
	array_push($menu,array('Estudantes','__Cadastro','ed_pibic_aluno.php')); 

if ($user_nivel >= 9)
	{	
	array_push($menu,array('Estudantes','__Consultar aluno (SIGA/PUCPR)','pibic_consulta_aluno.php')); 
	}
	
	array_push($menu,array('Pareceristas','Pareceristas','')); 
	array_push($menu,array('Pareceristas','__Resumo','paraceristas_rel_resumo.php')); 
	array_push($menu,array('Pareceristas','__Cadastro','ed_pareceristas.php')); 
	array_push($menu,array('Pareceristas','Relatório','')); 
	array_push($menu,array('Pareceristas','__Pareceristas / Instituição','paraceristas_rel_parecerista_instituicao.php')); 
	array_push($menu,array('Área do conhecimento','Área do conhecimento','ed_ajax_areadoconhecimento.php')); 
	array_push($menu,array('Área do conhecimento','Área do conhecimento (relatório)','rel_ajax_areadoconhecimento.php')); 
	array_push($menu,array('Área do conhecimento','Área do conhecimento (desbilitar semic)','ajax_areadoconhecimento_sel.php')); 

if ($user_nivel >= 9)
	{	
	array_push($menu,array('Ferramentas','__Atualizar estudantes pelo código (SIGA/PUCPR) automárico','estudantes_atualizar.php')); 
	array_push($menu,array('Eventos do sistema','__Atividades do sistema','ed_pic_atividades.php')); 

	array_push($menu,array('Modalidade de Bolsas','Modalide de bolsas','ed_pibic_bolsa_tipo.php')); 
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
<?php
menus($menu,'3');
?>
</TABLE>
<?php
require("foot.php");	
?>