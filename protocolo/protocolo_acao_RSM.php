<?php
require ("../pibicpr/_email.php");

$cp = array();
$cp[0] = array('$HV', '', $dd[0], False, False);
$cp[1] = array('$HV', '', $dd[1], False, False);
$cp[2] = array('$M', '', 'Resolução', False, True);
$cp[3] = array('$O : &DEFERIDO:DEFERIDO&INDEFERIDO:INDEFERIDO', '', 'Resolução', True, True);
$cp[5] = array('$O : &S:SIM&N:NÃO', '', 'Apresentação Pôster', True, True);
$cp[6] = array('$O : &S:SIM&N:NÃO', '', 'Apresentação Oral', True, True);

$op = '@:Manter aberto';
$op .= '&F:Finalizar protocolo';
$op .= '&C:Cancelar protocolo';
$cp[4] = array('$O ' . $op, '', 'Ação', True, True);
$cp[7] = array('$T80:4', '', 'Descrição dos motivos', Falso, True);
$cp[8] = array('$B8', '', 'Gravar', False, True);

$tela = $form -> editar($cp, '');

if ($form -> saved > 0) {
	/* Dados */
	$ssta = $dd[4];
	$proto_nr = strzero($pr -> line['id_pr'], 5) . '/' . $pr -> line['pr_ano'];
	$proto = $pr -> line['pr_protocolo_original'];
	$pb -> le('', $proto);
	$titulo_antigo = $pb -> pb_titulo_plano;
	$descricao = $dd[3];

	/* Recupera dados do projeto */
	require ("../_class/_class_pibic_historico.php");
	$ph = new pibic_historico;
	$titulo_novo = $pr -> line['pr_descricao'];
	$motivo = 'RSM';
	$ac = 611;
	$hist = 'Análise de recurso - apresentação, resultado: ';
	$rs = '';
	if ($dd[5] == 'S')
	{
		$rs = 'APRESENTAÇÃO EM PÔSTER';
	}
	if ($dd[6] == 'S')
	{
		$rs = 'APRESENTAÇÃO ORAL';
	}
	if (($dd[5] == 'S') and ($dd[6] == 'S'))
	{
		$rs = 'APRESENTAÇÃO NAS MODALIDADES ORAL E PÔSTER';
	}
	if (($dd[5] == 'N') and ($dd[6] == 'N'))
	{
		$rs = 'Não indicado para apresentação pública.';
	}
	
	$aluno1 = '';
	$aluno2 = '';
	$motivo = '';
	$obs = 'Análise de recurso '.strzero($dd[0],5);
	$obs .= '<BR><B><font color="blue">'.$rs.'</font>';
	$hist .= '<font color="blue">'.$rs.'</font>';
	
	switch($ssta) {
		case 'F' :
		
			/* Realizar a ação */
			$sql = "select * from semic_nota_trabalhos where st_codigo = '$proto'";
			$rlt = db_query($sql);
			
			if ($line = db_read($rlt))
				{
					if ($dd[5] == 'N') { $dd[5] = ''; }
					if ($dd[6] == 'N') { $dd[6] = ''; }
					$sql = "update semic_nota_trabalhos set 
								st_poster = '".$dd[5]."',
								st_nota_rel_final = 800,
								st_oral = '".$dd[6]."'
							where id_st = ".$line['id_st'];
					$rlt = db_query($sql);
				}

			/* Gravar histórico */
			$ph -> inserir_historico($proto, $ac, $hist, $aluno1, $aluno2, $motivo, $obs);
			echo '<BR>Salvar historico: <font color="green">ok</font>';

			/* Comunicar pesquisador */
			$professor_nome = $pb -> pb_professor_nome;

			/* Oculta erros */
			ini_set('display_errors', 0);
			ini_set('error_reporting', 0);

			require ('../_class/_class_ic.php');
			$descricao = $dd[3].chr(13).chr(13).'<BR><BR>'.$hist;
			$ic = new ic;
			$idp = 'prot_' . $tipo . '_RS' . $dd[4];
			$ic = $ic -> ic($idp);
			$assun = $ic['nw_titulo'];
			$texto = mst($ic['nw_descricao']);
			$texto = troca($texto, '$NOME', $professor_nome);
			$texto = troca($texto, '$PROTOCOLO', $proto_nr);
			$texto = troca($texto, '$MOSTRA', $pb -> mostar_dados());
			$texto = troca($texto, '$DESCRICAO', $descricao.'<BR><BR>'.$dd[7]);
			
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
			echo '<BR>Sem modificação: <font color="green">ok</font>';
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