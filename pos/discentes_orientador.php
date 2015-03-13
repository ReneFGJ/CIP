<?
$breadcrumbs = array();
require ("cab_pos.php");
require ("../include/sisdoc_debug.php");

require ("../_class/_class_docentes.php");
$doc = new docentes;

require ($include . "_class_form.php");
$form = new form;

$cp = array();
array_push($cp, array('$H8', '', '', False, False));
array_push($cp, array('$Q pos_nome:pos_codigo:select * from programa_pos where pos_ativo = 1 order by pos_nome', '', 'Selecione o PPG', True, True));
//array_push($cp,array('$O C:Cursando&T:Titulodo&A:Aguardando Entrega da Dissertação&X:Cancelado&R:Trancado','','',False,False));
echo $form -> editar($cp, '');

if ($form -> saved > 0) {
	require ("../_class/_class_discentes.php");
	$dis = new discentes;
	/* Recupera nome dos alunos não inseridos */
	$crachas = $doc -> docente_orientacao_sem_nome_aluno();

	if (count($crachas) > 0) {
		for ($r = 0; $r < count($crachas); $r++) {
			$crac = $crachas[$r];
			echo '<BR>Consultando ' . $crac;
			$cracha = $crachas[$r];
			$debug = 0;
			//echo '<div style="diplay: none;">';
			//require ('../pibicpr/pucpr_soap_pesquisaAluno.php');
			//echo '</div>';
		}
	}
	if (count($crachas) > 0) {
		echo '<BR>Buscando nome de ' . count($crachas) . ' alunos<BR>';
	}

	$doc -> docente_orientacao_excluir_cancelados();

	echo '<h3>Fluxo Discente</h3>';
	echo $doc -> docentes_orientacoes($dd[1], '');
}
require ("../foot.php");
?>