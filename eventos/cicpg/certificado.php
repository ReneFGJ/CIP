<?php
require ("cab.php");
require ("../../db_reol2_pucpr.php");
/* header */
require($include.'sisdoc_debug.php');
require ($include . '_class_form.php');
$form = new form;
$form -> required_message = 0;
$form -> required_message_post = 0;

$cp = array();
array_push($cp, array('$H8', '', '', False, False));
array_push($cp, array('${', '', 'Central de Certificados e Declarações', False, False));
array_push($cp, array('$A', '', 'Emissão de Declaração de participação IC/IT da PUCPR 2013/2014', False, False));
array_push($cp, array('$S12', '', 'Código Cracha/Carterinha da PUCPR&nbsp;', False, True));
array_push($cp, array('$B8', '', 'Emitir certificado >>>', False, True));

array_push($cp, array('$H8', '', 'Emissão de Declaração de participação IC/IT da PUCPR 2013/2014', False, False));
array_push($cp, array('$H8', '', 'Código Cracha/Carterinha da PUCPR&nbsp;', False, True));
array_push($cp, array('$H8', '', 'Emitir certificado >>>', False, True));

array_push($cp, array('$A', '', 'Emissão de Certificado de apresentação de trabalhos (Oral/Pôster)', False, False));
//array_push($cp, array('${', '', 'Certificado de Participante Externo', False, False));
array_push($cp, array('$S15', '', '<NOBR>Informe o código do trabalho&nbsp;<BR><font class=lt0 >Ex: CI01, consulte seu código no <A HREF=http://www2.pucpr.br/reol/eventos/cicpg/sumario.php target=__new >sumário</A></font>', False, True));
array_push($cp, array('$B8', '', 'Emitir certificado >>>', False, True));
//array_push($cp, array('$}', '', 'CPF', True, True));

array_push($cp, array('$A', '', 'Emissão de Certificado de ouvinte', False, False));
//array_push($cp, array('${', '', 'Certificado de Ouvinte', False, False));
array_push($cp, array('$S15', '', 'Informe o CPF&nbsp;', False, True));
array_push($cp, array('$B8', '', 'Emitir certificado >>>', False, True));
//array_push($cp, array('$}', '', 'CPF', True, True));

array_push($cp, array('$A', '', 'Emissão de Certificado de Avaliador', False, False));
//array_push($cp, array('${', '', 'Certificado de Avaliador', False, False));
array_push($cp, array('$S100', '', 'Informe seu e-mail&nbsp;', False, True));
array_push($cp, array('$B8', '', 'Emitir certificado >>>', False, True));

array_push($cp, array('$A', '', 'Emissão de Certificado de Orientador<br><FONT COLOR=RED CLASS=lt1>Somente para professores da PUCPR</font>', False, False));
//array_push($cp, array('${', '', 'Certificado de Avaliador', False, False));
array_push($cp, array('$S12', '', 'Informe seu Código Cracha/Carterinha da PUCPR&nbsp;', False, True));
array_push($cp, array('$B8', '', 'Emitir certificado >>>', False, True));
array_push($cp, array('$}', '', 'CPF', True, True));

echo '<BR><BR><BR><BR>';
$tela = $form -> editar($cp, '');

//if (strlen($dd[6].) > 0)
	{
		require("certificado_trabalho.php");
		require("certificado_declaracao.php");
		require("certificado_ouvinte.php");
		require("certificado_avaliador.php");
		require("certificado_orientador.php");
	}

echo '<table width="800" align="center">';
echo '<TR><TD>';
echo $tela;
echo '</table>';

echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
require ("foot.php");
?>