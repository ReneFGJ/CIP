<?php
require ("../pibicpr/_email.php");

require ("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

/* motivos */
$motivos = $pb->substituicao_motivo();
$mot = substr($pr->line['pr_justificativa'],0,3);
require ("../_class/_class_discentes.php");
$dc = new discentes;

$cp = array();
$cp[0] = array('$HV', '', $dd[0], False, False);
$cp[1] = array('$HV', '', $dd[1], False, False);
$cp[2] = array('$M', '', 'Resolução', False, True);
$cp[3] = array('$T80:5', '', '', True, True);

$op = '@:Manter aberto';
$op .= '&F:Finalizar protocolo';
$op .= '&C:Cancelar protocolo';
$cp[4] = array('$O ' . $op, '', 'Ação', True, True);
$cp[5] = array('$B8', '', 'Gravar', False, True);

$tela = $form -> editar($cp, '');

if ($form -> saved > 0) {
	/* Dados */
	$ssta = $dd[4];
	$proto_nr = strzero($pr -> line['id_pr'], 5) . '/' . $pr -> line['pr_ano'];
	$proto = $pr -> line['pr_protocolo_original'];
	$pb -> le('', $proto);
	$aluno_antigo = $pb -> line['pb_aluno'];
	$descricao = $dd[3];

	/* Recupera dados do projeto */
	require ("../_class/_class_pibic_historico.php");
	$ph = new pibic_historico;
	$aluno_novo = $pr -> line['pr_descricao'];
	$motivo = 'SBS';
	$ac = 90;
	$hist = 'Substituição de estudante (troca de aluno)';
	$aluno1 = $aluno_antigo;
	$aluno2 = $aluno_novo;
	$motivo = '';
	$dc->le('',$aluno_antigo);
	$obs = 'DE: <I>'.$dc->pa_nome. '</I> ('.$aluno_antigo.')';
	$dc->le('', $aluno_novo);
	$obs .= '<BR>PARA: <I>' . $dc->pa_nome. '</I> ('.$aluno_novo.')';
	$obs .= '<BR>Motivo da substituição: <B>'.$motivos[$mot].'</B>';
	$obs .= '<BR>Protocolo de serviço: ' . strzero($dd[0], 5);
	
	switch($ssta) {
		case 'F' :

			/* Gravar histórico */
			$ph -> inserir_historico($proto, $ac, $hist, $aluno1, $aluno2, $mot, $obs);
			echo '<BR>Salvar historico: <font color="green">ok</font>';

			/* Salvar informações no protocolo */
			$pb -> troca_estudante($proto, $aluno1, $aluno2);
			echo '<BR>Substituição de estudados: <font color="green">ok</font>';

			/* Comunicar pesquisador */
			$professor_nome = $pb -> pb_professor_nome;

			/* Oculta erros */
			ini_set('display_errors', 0);
			ini_set('error_reporting', 0);
			
			/* busca dados novos */
			$pb -> le('', $proto);

			require ('../_class/_class_ic.php');
			$ic = new ic;
			$idp = 'prot_' . $tipo . '_R' . $dd[4];
			$ic = $ic -> ic($idp);
			$assun = $ic['nw_titulo'];
			$texto = mst($ic['nw_descricao']);
			$texto = troca($texto, '$NOME', $professor_nome);
			$texto = troca($texto, '$PROTOCOLO', $proto_nr);
			$texto = troca($texto, '$MOSTRA', $pb -> mostar_dados());

			if (strlen($assun) == 0) {
				echo '<BR><font color="red">Mensagem ' . $idp . ' não existe</font>';
			} else {
				echo '<BR>Comunicar pesquisador: <font color="green">ok</font>';

				$email1 = trim($pb -> pb_prof_email_1);
				$email2 = trim($pb -> pb_prof_email_2);

				if (strlen($email1) > 0) {
					echo '<BR>enviar email para ' . $email1 . ': <font color="green">ok</font>';
					enviaremail($email1, '', $assun, $texto);
				}
				if (strlen($email2) > 0) {
					echo '<BR>enviar email para ' . $email2 . ': <font color="green">ok</font>';
					enviaremail($email2, '', $assun, $texto);
				}
			}

			/* Enviar copia para o IC */
			echo '<BR>Comunicar gestor do sistema (cópia): <font color="green">ok</font>';
			enviaremail($admin_email, '', $assun . ' (cópia)', $texto);
			
			/* Altera status do protocolo */
			echo '<BR>Encerrar protocolo de serviço: <font color="green">ok</font>';
			$pr->fecha_protocolo($proto_nr,$descricao);
			
			echo '<BR>Sucesso!';
			break;
		/* Sem alterações */
		case '@' :
			/* Atualiza status do protocolo */
			echo '<BR>Encerrar protocolo de serviço: <font color="green">ok</font>';
			//$pr->salva_protocolo($proto_nr,$descricao);
			break;
		/* Cancelamento do protocolo */
		case 'C' :
			/* Cancela protocolo */
			echo '<BR>Cancelado protocolo de serviço: <font color="green">ok</font>';
			$pr->cancela_protocolo($proto_nr,$descricao);
			break;
	}
} else {
	echo $tela;
}
?>