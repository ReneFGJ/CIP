<?php
require("cab_pibic.php");
require("submit_pre.php");

echo '<link rel="stylesheet" href="'.$http.'pibic/css/css_pibic_submit.css">'.chr(13);
//echo '<h2>Submissão de projeto</h2>';
//
//echo '<center><BR><BR>';
//echo '<h1>Em manutenção</h1>';

//if ($ss->user_login != 'RENE.GABRIEL')
//	{
//	exit;
//	}
require('../_class/_class_docentes.php');
$dc = new docentes;

require('../_class/_class_pibic_projetos_v2.php');
$prj = new projetos;

$prj->session_zera();

$professor = trim($ss->user_cracha);
$dc->le($professor);

$bl = $dc->blacklist();
if (strlen($bl) > 0)
	{
	echo '<div>';
	echo '<font class="lt2">';
	echo '<img src="../img/icone_exclamation.png" height="90" align="left">';
	echo 'Prezado Professor,<BR><BR>';
	echo 'De acordo com as normas da IC, 3.3.h, você está impedido de submeter projeto neste edital decorrente de penalidade por sua ausência no SEMIC.';
	echo '</font>';
	echo '<div>';
	exit;
	}
	
/* Regra de titulação */
$dc->valida_titulacao_orientador($ss->user_cracha);

echo $prj->resumo($ss->user_cracha,date("Y"));
//require("submit_pre.php");
/* Projetos submetidos */
	
	/*** SUBMISSAO **/
	echo $prj->mostra_projetos();
	/* Submeter novo projeto */
	echo $prj->botao_novo_projeto();
	
require("../foot.php");
?>
