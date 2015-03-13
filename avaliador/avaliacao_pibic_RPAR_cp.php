<?php
$cp = array();
array_push($cp, array('$H8', 'id_pp', '', False, True));
array_push($cp, array('$H8', '', '', False, True));
array_push($cp, array('$H8', '', '', False, True));
array_push($cp, array('$H8', '', '', False, True));
array_push($cp, array('$H8', '', '', False, True));

/** Tabela **/
$tabela = 'pibic_parecer_' . date("Y");

/** Data, hora e estatus da avaliavcao **/
array_push($cp, array('$HV', 'pp_parecer_data', date('Yms'), False, True));
array_push($cp, array('$HV', 'pp_parecer_hora', date('H:m'), False, True));
array_push($cp, array('$HV', 'pp_status', '@', False, True));
$ccor = '<font color=blue >';

/** Primeira questão **/
$cap = "1) Clareza, legibilidade e objetividade (português, organização geral do texto, figuras, gráficos, tabelas, referências, adequação do relatório ao modelo do Programa):";
$opc = 'Excelente';
$opc .= ':Excelente<BR>&';
$opc .= 'Bom';
$opc .= ':Bom' . $ccor . ' (existem pequenos ajustes que precisem ser corrigidos, justificar).</font>.<BR>&';
$opc .= 'Regular';
$opc .= ':Regular' . $ccor . ' (muitas correções são necessárias, assinalar no campo dos comentários ).</font><BR>&';
$opc .= 'Ruim';
$opc .= ':Ruim ' . $ccor . ' (o relatório precisa ser refeito)</font>.';
array_push($cp, array('$H8', 'id_pp', '', True, True));
array_push($cp, array('$R ' . $opc, 'pp_abe_01', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_02', $comentarios, False, True));

/** Segunda Questão **/
$cap = $sp . '2)	Na estruturação do relatório, os itens: introdução, desenvolvimento, resultados parciais, etapas futuras e referências bibliográficas, estão apresentados adequadamente, bem como, mantêm relação coerente entre si. Neste ponto este relatório está:';
$opc = 'adequado:adequado<BR>&';
$opc .= 'parcialmente adequado: parcialmente adequado<BR>&';
$opc .= 'inadequado:inadequado';
array_push($cp, array('$R ' . $opc, 'pp_abe_03', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_04', $comentarios, False, True));

/** Terceira Questão **/
$cap = $sp . '3) Cumprimento do Cronograma previsto:';
$opc = 'Excelente, :Excelente ' . $ccor . '(as atividades estão sendo realizadas dentro do cronograma previsto)</font>.<BR>&';
$opc .= 'Bom, :Bom ' . $ccor . '(a maior parte das atividades previstas foram cumpridas. Houve algumas mudanças nos objetivos e/ou cronograma, as quais foram devidamente justificadas)</font>.<BR>&';
$opc .= 'Regular, :Regular ' . $ccor . '(importante atraso no cronograma que poderá comprometer o cumprimento dos objetivos inicias propostos. Há necessidade de ajuste no cronograma e/ou objetivos do projeto. Justificativas devem ser apresentadas)</font>.<BR>&';
$opc .= 'Ruim, :Ruim ' . $ccor . '(severo atraso no cronograma ou mudança não justificada ou não apropriada em relação aos objetivos iniciais propostos)</font>.<BR>&';
array_push($cp, array('$R ' . $opc, 'pp_abe_05', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_06', $comentarios, False, True));
$comentarios = 'Comentários sobre sua avaliação deste item caso tenha assinalado as alternativas ruim:';

/** Quarta questão **/
$cap = $sp . '4) Resultados parciais obtidos:';
$opc = 'Excelente';
$opc .= ':Excelente' . $ccor . ' (resultados parciais altamente relevantes para o prosseguimento das atividades).</font><BR>&';
$opc .= 'Bom';
$opc .= ':Bom' . $ccor . ' (dados obtidos são adequados, bem como a análise preliminar. Na próxima etapa deve haver complementação e aprofundamento)</font>.<BR>&';
$opc .= 'Regular';
$opc .= ':Regular' . $ccor . ' (dados obtidos não foram analisados, dificultando a avaliação da sua relevância no contexto do projeto)</font>.<BR>&';
$opc .= 'Ruim';
$opc .= ':Ruim' . $ccor . ' (poucos ou nenhum resultado relevante no contexto do projeto foram apresentados)</font>.<BR>&';
$opc .= 'Não se aplica';
$opc .= ':Não se aplica' . $ccor . ' (de acordo com o cronograma inicial apresentado, não é esperado a apresentação de resultados nesta etapa do trabalho)</font>.<BR>&';
$comentarios = 'Comentários sobre sua avaliação deste item, caso tenha assinalado as alternativas regular ou ruim:';
array_push($cp, array('$R ' . $opc, 'pp_abe_07', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_08', $comentarios, False, True));

/** Quinta questão **/
$cap = $sp . '5)	No caso desta pesquisa de IC ser parte de uma pesquisa de mestrado, doutorado ou parte de projeto  mais amplo, assinale se:';
$opc = 'as atividades descritas não estão adequadas para uma proposta de IC (obrigatória 	a modificação, ver justificativa).';
$opc .= ': as atividades descritas não estão adequadas para uma proposta de IC (obrigatória a modificação, ver justificativa).<BR>&';
$opc .= ' as atividades descritas são parcialmente válidas para IC ( sugerir modificações na justificativa).';
$opc .= ': as atividades descritas são parcialmente válidas para IC ( sugerir modificações na justificativa).<BR>&';
$opc .= ' as atividades descritas são adequadas para IC.';
$opc .= ':as atividades descritas são adequadas para IC.<BR>&';
$opc .= 'não se aplica: não se aplica.';
$comentarios = 'Comentários sobre sua avaliação deste item caso tenha assinalado as alternativas de "não estão adequadas" ou "parcialmente":';
array_push($cp, array('$R ' . $opc, 'pp_abe_11', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_12', $comentarios, False, True));

/** Sexta questão **/
$cap = $sp . '<B>6) O relatório parcial apresenta graves problemas relacionados a orientação desenvolvida e/ou problemas metodológicos que comprometem a formação do aluno de iniciação científica. Indique tais problemas no campo de comentários restrito. O avaliador considera que deve ser realizada uma reunião com o professor orientador?';
$opc = 'NÃO:NÃO<BR>&';
$opc .= 'SIM:SIM';
$comentarios = 'Comentários sobre a descrição dos problemas (item restrito ao comitê gestor)';
array_push($cp, array('$R ' . $opc, 'pp_abe_14', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_16', $comentarios, False, True));

/** Sétima Questão **/
$cap = $sp . '<B>7) Outros comentários (o avaliador fica livre para suas sugestões e comentários sobre a apreciação geral do trabalho)</B><BR>.';
array_push($cp, array('$T80:8', 'pp_abe_13', $cap, True, True));

if (strlen($ceua_s1 . $cep_s1) > 0) {
	/** Questão quatro **/
	$cap = $sp . '8) <B>Comitê de Ética em Pesquisa - O projeto de pesquisa envolve participação individual ou coletivamente,
seres humano ou animais em seus experimentos, sendo necessário avaliação dos Comitês de Ética da PUCPR/PR ?</B><BR>.';

	$s = 'Não apresentou o protocolo de aprovação';
	$ope .= $s . ':' . $s . '<BR>';

	$s = 'Foi aprovado pelo Comitê de Ética';
	$ope .= '&' . $s . ':' . $s . '<BR>';

	array_push($cp, array('$R ' . $ope, 'pp_abe_09', $cap, True, True));
} else {
	$cap = $sp . '8) <B>Comitê de Ética em Pesquisa - O projeto de pesquisa envolve participação individual ou coletivamente,
seres humano ou animais em seus experimentos, sendo necessário avaliação dos Comitês de Ética da PUCPR/PR ?</B><BR>.';

	$s = 'Não necessita passar pelos Comitês de Ética (não se aplica)';
	array_push($cp, array('$HV', 'pp_abe_09', $s, True, True));
	
}

/** Oitava Questão **/
$cap = $sp . '9)	Resultado da avaliação:';
$opc = '1:<font color=Green>Aprovado - comentários e sugestões devem ser incorporados no relatório final</font><BR>&';
$opc .= '2:<font color=red>Pendências - relatório parcial deve ser reapresentado realizando as devidas correções</font>';
array_push($cp, array('$R ' . $opc, 'pp_p01', $cap, True, True));


$nota = ' :Nota';
for ($r = 0; $r <= 10; $r = $r + 0.5) {
	$nota .= '&' . $r . ':' . number_format($r, 1);
}

array_push($cp, array('$M', '', 'Atribuia uma nota de 0 a 10 para o trabalho no geral', False, True));
array_push($cp, array('$O ' . $nota, 'pp_abe_15', 'Nota', True, True));

array_push($cp, array('$B8', '', 'Finaliza avaliação >>', False, True));
?>