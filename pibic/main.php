<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_windows.php');

if (strlen($user->cracha)==0)
	{ redirecina('index.php'); }

/*
 * Submissao aberta
 */
$submit_open = 1;

require("../_class/_class_pibic_bolsa_contempladas.php");
require("../_class/_class_pibic_submit_documento.php");

echo '<TABLE align="center" width="'.$tab_max.'" border="1" >';
echo '<TR valign="top" width="'.$tab_max.'" align="center">';
echo '<TD align="left">';

/**
 * Atividade de implementacao de bolsas
 */
{
	require("atividade_bolsa_implantacao.php");
}


	/* Mensagens */
	$tabela = 'main';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }
	
/**
 * Entrega de relatorio parcial e final
 */
	$tab_max = '100%';
	$pb = new pibic_bolsa_contempladas;
	$pb->pb_professor = $user->cracha;
	$id_pesq = $user->cracha;
	
	/*
	 * Relatï¿½rio parcial
	 */
	 
	 /* Correï¿½ï¿½o de relatï¿½rio parcial */
		//$tela = $pb->bolsa_relatorio_parcial_correcao_tarefas();
	
	//if (($user->cracha=='88888951') or ($user->cracha=='70006033')) 
	{
		require("atividade_resumo.php");
		
		$tela = $pb->bolsa_relatorio_final_lista();

		if (strlen($tela) > 0)
			{
				echo '<fieldset><legend>Relatório Final</legend>';
				echo $tela;
				echo '</fieldset>';
			}
	}
	
	/*
	 * Dados do professor
	 */ 
	require("pibic_professor.php");
	
	if (strlen($tela) ==0)
		{
			//echo '<center>';
			//echo msg('not_actividade');
		} else {
			
		}
		
echo '<TD width="210">';
//require("resume_menu_left_projetos.php");
echo '<BR>';
require("resume_menu_left_3.php");
echo '<BR>';
require("resume_menu_left_2.php");
echo '<BR>';
//require("resume_menu_left_mail.php");
echo '</table>';

	/* Submissï¿½o de novos projetos */
	//if (($submit_open == 1) and ($user->cracha == '88958022'))
		{
			require("atividade_submissao.php");
		}
	//echo '<BR><BR><center>';
	//echo '<font color="red" style="font-size:30px">Submissï¿½o encerrada</font>';
	//echo '<BR><BR><center>';
require("foot.php");
?>
