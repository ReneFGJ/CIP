<?php
require("cab.php");

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$Q pp_curso:pp_curso:select distinct pp_curso from pibic_professor where pp_ativo = 1 order by pp_curso','','Curso',True,True));
array_push($cp,array('$Q pp_centro:pp_centro:select distinct pp_centro from pibic_professor where pp_ativo >= 0 order by pp_centro','','Escola (opcional)',False,True));
array_push($cp,array('$[2010-'.date("Y").']D','','Vigência/Edital',True,False));

$tela = $form->editar($cp,'');
echo '<h1>Emissão de certificados por Curso</h1>';

echo $tela;
if ($form->saved > 0)
	{
		$linkp = 'certificado_emissao_serie.php?dd0=PP&dd0='.$dd[3].'&dd1='.$dd[1].'&dd2='.$dd[2];
		$linke = 'certificado_aluno_emissao_serie.php?dd0=PE&dd0='.$dd[3].'&dd1='.$dd[1].'&dd2='.$dd[2];
		echo '<BR><BR>';
		echo '<A HREF="'.$linkp.'">EMITIR CERTIFICADOS DOS ORIENTADORES</A>';
		echo '<BR><BR>';
		echo '<A HREF="'.$linke.'">EMITIR CERTIFICADOS DOS ESTUDANTES</A>';
		echo '<BR><BR><BR>';
	} else {
		echo '.';
	}

require("../foot.php");	
?>