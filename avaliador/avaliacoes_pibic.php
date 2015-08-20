<?
$parecer_pibic -> tabela = 'pibic_parecer_' . date("Y");

$tela = array('','','','','','','','','','','','');

/* Relatorio Parcial */
if (date("m") < 13) { $tela[0] = $parecer_pibic -> resumo_avaliador($par -> codigo, 'RPAR');
}

/* Correção do Relatório Parcial */
if (date("m") < 13) { $tela[1] = $parecer_pibic -> resumo_avaliador($par -> codigo, 'RPAC');
}

/* Submissão de projetos / plano */
if ((date("m") >= 5) and (date("m") < 10)) { $tela[2] = $parecer_pibic -> resumo_avaliador($par -> codigo, 'SUBMI');
}

/* Relatorio final */
if ((date("m") >= 7) and (date("m") <= 9)) { $tela[3] = $parecer_pibic -> resumo_avaliador($par -> codigo, 'RFIN');
}

/* Relatorio final - correcao */
if ((date("m") >= 7) and (date("m") <= 9)) { $tela[4] = $parecer_pibic -> resumo_avaliador($par -> codigo, 'RFNR');
}

for ($rx = 0; $rx < 10; $rx++) {
	if ($tela[$rx][0] > 0) { echo $tela[$rx][1];
	}
	$tot = $tot + $tela[$rx][0];
}
?>