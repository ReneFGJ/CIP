<?php
$trab = trim($dd[3]);
if (strlen($trab) > 0) {
	if (strlen($trab) == 12) { $trab = substr($trab, 3, 8);
	}
	if (strlen($trab) == 11) { $trab = substr($trab, 3, 8);
	}
	
	if (strlen($trab) == 8) {
		$sql = "select * from pibic_aluno where pa_cracha = '$trab' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			$nome2 = trim($line['pa_nome']);
			$cpf2 = trim($line['pa_cpf']);
			$cracha = trim($line['pa_cracha']);
			$idp = $line['id_pa'];
			$instituicao2 = 'PUCPR';
		}
		$link = '<A HREF="http://www2.pucpr.br/reol/eventos/cicpg/declaracao_emissao.php?dd0=' . $cracha . '"
					class="botao_certificado" target="_new">';
		$link .= 'Impressão da declaração de participação na IC/IT';
		$link .= '</A>';
		$tela = $link.$tela;
	} else {
		$tela = '<center><font color="red">Erro do código do aluno, informe o código completo do cracha, ou somente os oito digitos.</font></center>' . $tela;

	}
}
?>