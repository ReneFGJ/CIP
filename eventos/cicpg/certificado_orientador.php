<?php
$trab = trim($dd[18]);
if (strlen($trab) > 0) {
	if (strlen($trab) == 12) { $trab = substr($trab, 3, 8);
	}
	if (strlen($trab) == 11) { $trab = substr($trab, 3, 8);
	}
	
	if (strlen($trab) == 8) {
		$sql = "select * from pibic_bolsa_contempladas 
				inner join pibic_aluno on pb_aluno = pa_cracha
				where pb_professor = '$trab' 
				and pb_status <> 'C' and pb_ano = '2013'
				order by pb_protocolo
		";
		$rlt = db_query($sql);
		$sx = '<table width="100%" class="tabela01">';
		$sx .= '<TR><TH>Protocolo<TH>Título / aluno';
		while ($line = db_read($rlt)) {
			$sx .= '<TR valign="top"><TD rowspan=2>'.$line['pb_protocolo'];
			$sx .= '<TD>'.$line['pb_titulo_projeto'];
			$sx .= '<TD>';
			
			$link = '<A HREF="http://www2.pucpr.br/reol/eventos/cicpg/declaracao_orientador.php?dd0=' . $line['pb_protocolo'] . '&dd90='.md5($line['pb_protocolo']).'" 
						class="botao_certificado" target="_new">';
			$link .= 'Imprimir';
			$link .= '</A>';
			$sx .= '<TD>'.$link;
			$sx .= '<TR><TD><I>'.$line['pa_nome'].'</I>';
		}
		$sx .= '</table>';
		
		$link = '<A HREF="http://www2.pucpr.br/reol/eventos/cicpg/declaracao_emissao.php?dd0=' . $cracha . '"
					class="botao_certificado" target="_new">';
		$link .= 'Impressão da declaração de participação na IC/IT';
		$link .= '</A>';
		$tela = $sx.$tela;
	} else {
		$tela = '<center><font color="red">Erro do código do aluno, informe o código completo do cracha, ou somente os oito digitos.</font></center>' . $tela;

	}
}
?>