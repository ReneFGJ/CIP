<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_email.php');

require("../_class/_class_ic.php");

if (strlen($dd[0])==0)
	{
		$dd[0] = $_SESSION['ART']; 
	} else {
		$_SESSION['ART'] = $dd[0];
	}

	/* Dados da Classe */
	require("../_class/_class_pibic_historico.php");	
	require('../_class/_class_pibic_projetos_v2.php');	
	$prj = new projetos;

	$dd0 = round($dd[0]);

	$prj->le($dd0);
	$line = $prj->line;
	
	echo $prj->mostra($line);
	
	echo '<TR><TD colspan=3><h2>Planos de alunos</h2>';
	echo '<TR><TD colspan=4>';
	echo $prj->mostra_planos_projetos();
	echo '</table>';	

	
		if (($prj->status != '!') and ($prj->status != 'X'))
		{
			$prj->le($dd[0]);
			$sx .= '<fieldset><legend>'.msg('acoes').'</legend>';
			$sx .= $prj->projetos_acoes('3');
			$sx .= '</fieldset>';
			
			/* Indicar avaliador */
			require_once('../_class/_class_parecer_pibic.php');
			$pa = new parecer_pibic;
			$pa->tabela = 'pibic_parecer_'.date("Y");
			$pa->table_exists($pa->tabela);	
			
			$pa->protocolo = $prj->protocolo;
			$sx .= '<TR><TD>';
			$sx .= '<fieldset><legend>'.msg('avaliacoes').'</legend>';
			if ($user_nivel == 9) { $sx .= $pa->parecer_indicacao(''); }
			$sx .= $pa->parecer_indicacao_row('');
			$sx .= '</fieldset>';
		}
	if ($prj->status != 'E')
		{		
			$sx .= $prj->acao_01();
		}
	
	$his = new pibic_historico;
	$sx .= $his->mostra_historico($prj->protocolo);
	
	echo $sx;
?>

