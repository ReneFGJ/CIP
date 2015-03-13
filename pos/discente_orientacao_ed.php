<?php
require('cab_pos.php');
require($include.'sisdoc_data.php');
global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');


require("../_class/_class_docentes.php");
	$cl = new docentes;
	$cp = $cl->cp_docente_orientacoes();
	$tabela = 'docente_orientacao';
	
	$http_edit = page();
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Ediçãoo */
	echo '<h1>Fluxo Discente</H1>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			if (strlen($dd[0])==0)
				{
					require("../_class/_class_discentes.php");
					$dis = new discentes;
					/* Recupera nome dos alunos não inseridos */
					$crachas = $cl->docente_orientacao_sem_nome_aluno();
					if (count($crachas) > 0)
					{ for ($r=0;$r < count($crachas);$r++) 
					{
						$cracha = $crachas[$r];
						$debug = 0;
						require('pucpr_soap_pesquisaAluno.php'); 
					}
				}
			
			//$cl->updatex();
			redirecina('discente_orientacao.php');
		}
		
?>


