<?php
require("cab_pibic.php");
require($include."sisdoc_tips.php");

/* RN: Se for edição, repassa número do protocolot */
if (strlen($dd[89]) > 0)
	{
		$_SESSION['protocolo'] = $dd[89];
		$proto = $dd[89];
	} else {
		$proto = $_SESSION['protocolo'];		
	}

require("../_class/_class_position.php");
$pos = new posicao;
$pos->items = array(array('título do projeto<BR>do professor','00',''),
			  array('dados do projeto','00','submit_phase_1.php'),
			  array('plano do aluno','00','submit_phase_3_sel.php'),
			  array('pibic jr','00','submit_phase_4_sel.php'),
			  array('finalização','01','submit_pibic_projeto.php'));
$pos->position = 0;
	
require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."cp2_gravar.php");
require("../_class/_class_ged.php");
$ged = new ged;

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;

/* Mostra projeto */
echo $pos->show(3,5,array());
echo '<fieldset>';
echo '<BR>';

if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }

if (strlen($proto)==0)
	{ redirecina('main.php'); }

$prj->protocolo = $proto;
echo $prj->mostra_projeto();

echo '<HR>';
echo $prj->resumo_planos();

$editar = 1;

$planos = round($prj->plano_pibic) + round($prj->plano_pibiti);
$planost = round($prj->plano_pibic) + round($prj->plano_pibiti) + round($prj->plano_pibic_em);

$_SESSION['proto_aluno']='';

	{
		$sx .= '<table width="100%"><TR align="center">';
		if ($planos < 2)
			{
			$sx .= '<TD>';
			$sx .= '<A HREF="submit_phase_3.php?dd0=NEW">';
			$sx .= '<img src="img/botao/button_submeter_plano_on.png" name="but2" 
						onmouseover="document.but2.src=\'img/botao/button_submeter_plano.png\';"
						onmouseout="document.but2.src=\'img/botao/button_submeter_plano_on.png\';"
						>';
			$sx .= '</A>';
			$sx .= '</A>';
			} else {
				$sx .= '<TD>';
				$sx .= '<img src="img/botao/button_limite_planos.png">';				
			}		
		$sx .= '<TD>';
		if (round($prj->plano_pibic_em) < 1)
			{
			$sx .= '<A HREF="submit_phase_4.php?dd0=NEW">';
			$sx .= '<img src="img/botao/button_submeter_plano_jr_on.png" name="but1" 
						onmouseover="document.but1.src=\'img/botao/button_submeter_plano_jr.png\';"
						onmouseout="document.but1.src=\'img/botao/button_submeter_plano_jr_on.png\';"
						>';
			$sx .= '</A>';
			} else {
				$sx .= '<TD>';
				$sx .= '<img src="img/botao/button_limite_planos.png">';				
			}	

		$sx .= '</table>';
		echo $sx;
	}
echo '<BR><BR><HR>PLANOS DE TRABALHOS</HR>';
if ($planost > 0)
	{
		echo $prj->resumo_planos_list('1');
	} else {
		echo 'Nenhum plano localizado.';
	}
echo '<BR><BR>';
if ($planost > 0)
	{
			$sx = '<center>';
			$sx .= '<A HREF="submit_phase_end.php">';
			$sx .= '<img src="img/botao/button_submit.png" name="but1" 
						onmouseover="document.but1.src=\'img/botao/button_submit_on.png\';"
						onmouseout="document.but1.src=\'img/botao/button_submit.png\';"
						>';
			$sx .= '</A>';
			echo $sx;
	
	}
echo '<BR><BR><BR><BR><BR>';
echo '</fieldset>';
require("foot.php");
?>