<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


$file = '../messages/msg_index.php';
if (file_exists($file)) { require($file); } 

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();

array_push($menu,array('Orientações','__Professores x Formação','professores_orientacoes.php'));

array_push($menu,array('Orientadores','Orientadores '.(date("Y")-1).'-'.(date("Y")),'ic_professores.php?dd1='.(date("Y")).'&dd2='.(date("Y")-1)));
array_push($menu,array('Orientadores','Histórico dos orientadores ','ic_professores_first.php?dd1='.(date("Y")).'&dd2='.(date("Y")-1)));
array_push($menu,array('Orientadores','Profissao IC (Renovações) '.(date("Y")-1).'/'.date("Y"),'ic_alunos_ic.php?dd1='.(date("Y")-2).'&dd2='.(date("Y")-1)));
array_push($menu,array('Orientadores','Censo Anual (Sillas) ','rel_bolsa_aluno_xml.php'));
array_push($menu,array('Orientadores','Orientadores ativos x número (SGA)','rel_bolsa_orientador_ativo.php'));



/////////////////////////////////////////////////// MANAGERS
$curso = $_SESSION['curso_nome'];   
$cursoc = $_SESSION['curso_codigo'];
$campus = $_SESSION['campus'];
if (strlen($campus) == 0)
	{ $campus = 'Todos'; }

array_push($menu,array('Indicadores de projetos','Curso','indicador_curso_01.php'));
if (strlen($curso) > 0)
	{
	array_push($menu,array('Indicadores de projetos','__'.$curso,''));
	array_push($menu,array('Indicadores de projetos','__Campus: <B>'.$campus.'</B>','indicador_campus_sele.php'));		 
	array_push($menu,array('Indicadores de projetos','__Docentes envolvidos (2)','indicador_curso_02.php'));
	array_push($menu,array('Indicadores de projetos','__Dicentes envolvidos (3)','indicador_curso_03.php'));
	}
array_push($menu,array('Perfil dos Orientadores','Perfil','indicador_orientador_01.php'));
array_push($menu,array('Perfil dos Orientadores','Perfil por Planos','indicador_orientador_02.php'));	


if ($perfil->valid('#ADM')) 
		{
			array_push($menu,array('Relatório','Guia do estudante ','ic_guia_do_estudante.php?dd1='.(date("Y")-2).'&dd2='.(date("Y")-1)));	
				
		}

///////////////////////////////////////////////////// redirecionamento
if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}
?>

<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="index.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?php
	$tela = menus($menu,"3");

require("../foot.php");	
?>