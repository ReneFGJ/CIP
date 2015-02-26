<?
require("cab.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_email.php');
require_once('../_class/_class_pibic_comment.php');
$comme = new comment;

require_once('../_class/_class_ged.php');
$ged = new ged;	
$popup = 'sim';
require('../_class/_class_pibic_projetos.php');	
$pj = new pibic_projetos;

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	

if (strlen($dd[0])==0)
	{ echo 'protocolo não definido'; exit; }
$pj->le($dd[0]);
$proto = $pj->protocolo;
$pa->protocolo = $proto;
$pa->tabela = "pibic_parecer_".date("Y");

echo '<table width="'.$tab_max.'" class="lt1">';
echo '<TR><TD>';

echo '<fieldset><legend>'.msg('plano_professor').'</legend>';
echo '<font class="lt3">Status: '.$pj->status().' em '.$date->stod($pj->update).'</font>';

echo $pj->mostra_projeto();
echo '</fieldset>';

echo '<TR><TD>';
if ($user_nivel == 9) {
	echo '<fieldset><legend>'.msg('acoes').'</legend>';
	echo $pj->projetos_acoes('3');
	echo '</fieldset>';
}

require_once('../_class/_class_parecer_pibic.php');
$pa = new parecer_pibic;
$pa->tabela = 'pibic_parecer_'.date("Y");
$pa->table_exists($pa->tabela);

$pa->protocolo = $pj->protocolo;
echo '<TR><TD>';
echo '<fieldset><legend>'.msg('avaliacoes').'</legend>';
if ($user_nivel == 9) { echo $pa->parecer_indicacao(''); }
echo $pa->parecer_indicacao_row('');
echo '</fieldset>';

echo '<TR><TD>';
echo '<fieldset><legend>'.msg('plano_aluno').'</legend>';
echo $pj->resumo_planos_list('3');
echo '--comments--';
$comme->codigo = $pj->protocolo;
echo $comme->comment_display();
echo '</fieldset>';

echo '</table>';
//mostra_plano
	
require("foot.php");	
?>
