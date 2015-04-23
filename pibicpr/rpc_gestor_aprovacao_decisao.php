<?php
require ("cab.php");
require ($include . 'sisdoc_email.php');
echo '<h1>Decisão da Reunião de Comitê Gestor</h1>';

require ("../_class/_class_docentes.php");
$dc = new docentes;

require ("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require ("../_class/_class_pibic_historico.php");
$hs = new pibic_historico;

$chk = checkpost($dd[0] . $dd[1]);

if ($chk == $dd[2]) {
	$pb -> le('', $dd[0]);
	echo $pb -> mostar_dados();

	/* Checa estatus = 2 (pendencia) */
	$sta = $pb -> line['pb_relatorio_parcial_correcao_nota'];
	if ($sta != '2') {
		echo '<font color="red">Este relatório não está com pendência!';
		exit ;
	}
	$cp = array();
	array_push($cp, array('$HV', '', $dd[0], True, True));
	array_push($cp, array('$HV', '', $dd[1], True, True));
	array_push($cp, array('$HV', '', $dd[2], True, True));

	array_push($cp, array('$T80:6', '', 'Histórico', True, True));
	array_push($cp, array('$O : &SIM:SIM', '', 'Confirma operação', True, True));

	require ($include . '_class_form.php');
	$form = new form;

	require ("../_class/_class_ic.php");
	$ic = new ic;
	$cod = 'ic_gt_rp_' . $dd[1];
	$ic = $ic -> ic($cod);
	$txt = $ic['nw_descricao'];
	$ass = $ic['nw_titulo'];

	$tela = $form -> editar($cp, '');

	if ($form -> saved > 0) {
		/* recupera e-mail do professor */
		$prof = $pb -> line['pb_professor'];
		$dc -> le($prof);
		$email1 = $dc -> line['pp_email_1'];
		$email2 = $dc -> line['pp_email_2'];

		/* SALVA HISTORICO */
		$proto = $pb -> line['pb_protocolo'];
		$ac = '241';
		$hist = $ass;
		$aluno1 = '';
		$aluno2 = '';
		$motivo = '444';

		$obs = 'Em reunião do comitê gestor decidiu-se pelo(a): ' . $ass . '<HR>' . $dd[3];
		$hs -> inserir_historico($proto, $ac, $hist, $aluno1, $aluno2, $motivo, $obs);

		/* Envia e-mail */
		$TITULO = $pb -> line['pb_titulo_projeto'];
		$PROTOCOLO = $pb -> line['pb_protocolo'];
		$ALUNO = $pb -> line['pa_nome'];

		$texto = troca($txt, '$TITULO', $TITULO);
		$texto = troca($texto, '$PROTOCOLO', $PROTOCOLO);
		$texto = troca($texto, '$CONTEUDO', $dd[3]);
		$texto = troca($texto, '$ALUNO', $ALUNO);
		$texto = mst($texto);
		$id = 'ic';
		$style = '<font style=font-family: Tahoma, Arial; font-size: 12px; line-height: 150%; >';
		$e4 = '<TABLE width=600 ><TR><TD><img src=' . $http . 'img/email_' . $id . '_header.png >
				<TR><TD>
				<BR>' . $style . $texto . '</font><BR>
				<img src=' . $http . 'img/email_' . $id . '_foot.png ></TABLE>';
		$dx = '<BR><BR><BR>
					<font style="font-size: 8px;">COD: ' . $cod . '</font>';

		require ('_email.php');
		echo '<BR>Comunicando por e-mail';
		$email = array('renefgj@gmail.com', 'pibicpr@pucpr.br', $email1, $email2);
		for ($r = 0; $r < count($email); $r++) {
			$em = trim($email[$r]);
			if (strlen($em) > 0) {
				enviaremail($em, '', $ass . '[' . $PROTOCOLO . ']', $e4 . $dx);
			}
			echo 'e-mail enviado para ' . $email[$r];
		}

		/* Update da avaliacao */
		echo '<BR>Atualizando bolsas';

		if ($dd[1] == 'APR') {
			$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial_correcao_nota = '4' where pb_protocolo = '$proto' ";
		} else {
			$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial_correcao_nota = '3' where pb_protocolo = '$proto' ";
		}

		$rlt = db_quey($sql);

		echo '<h2><font color="green">Operação efetuada com sucesso!</font>';
		exit ;

	} else {
		echo '<table width="100%" class="tabela00">';
		echo '<TR valign="top"><TD>';
		echo $tela;
		echo '<TD width="40%">';
		echo '<B>' . $ass . '</B><BR>';
		echo mst($txt);
		echo '<BR><BR><font class="lt0">COD: ' . $cod . '</font>';
		echo '</table>';
	}

} else {
	echo 'ERRO DE POST';
}
?>