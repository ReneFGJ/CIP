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

/** Primeira quest�o **/
$cap = "1) Clareza, legibilidade e objetividade (portugu�s, organiza��o geral do texto, figuras, gr�ficos, tabelas, refer�ncias, adequa��o do relat�rio ao modelo do Programa):";
$opc = 'Excelente';
$opc .= ':Excelente<BR>&';
$opc .= 'Bom';
$opc .= ':Bom' . $ccor . ' (existem pequenos ajustes que precisem ser corrigidos, justificar).</font>.<BR>&';
$opc .= 'Regular';
$opc .= ':Regular' . $ccor . ' (muitas corre��es s�o necess�rias, assinalar no campo dos coment�rios ).</font><BR>&';
$opc .= 'Ruim';
$opc .= ':Ruim ' . $ccor . ' (o relat�rio precisa ser refeito)</font>.';
array_push($cp, array('$H8', 'id_pp', '', True, True));
array_push($cp, array('$R ' . $opc, 'pp_abe_01', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_02', $comentarios, False, True));

/** Segunda Quest�o **/
$cap = $sp . '2)	Na estrutura��o do relat�rio, os itens: introdu��o, desenvolvimento, resultados parciais, etapas futuras e refer�ncias bibliogr�ficas, est�o apresentados adequadamente, bem como, mant�m rela��o coerente entre si. Neste ponto este relat�rio est�:';
$opc = 'adequado:adequado<BR>&';
$opc .= 'parcialmente adequado: parcialmente adequado<BR>&';
$opc .= 'inadequado:inadequado';
array_push($cp, array('$R ' . $opc, 'pp_abe_03', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_04', $comentarios, False, True));

/** Terceira Quest�o **/
$cap = $sp . '3) Cumprimento do Cronograma previsto:';
$opc = 'Excelente, :Excelente ' . $ccor . '(as atividades est�o sendo realizadas dentro do cronograma previsto)</font>.<BR>&';
$opc .= 'Bom, :Bom ' . $ccor . '(a maior parte das atividades previstas foram cumpridas. Houve algumas mudan�as nos objetivos e/ou cronograma, as quais foram devidamente justificadas)</font>.<BR>&';
$opc .= 'Regular, :Regular ' . $ccor . '(importante atraso no cronograma que poder� comprometer o cumprimento dos objetivos inicias propostos. H� necessidade de ajuste no cronograma e/ou objetivos do projeto. Justificativas devem ser apresentadas)</font>.<BR>&';
$opc .= 'Ruim, :Ruim ' . $ccor . '(severo atraso no cronograma ou mudan�a n�o justificada ou n�o apropriada em rela��o aos objetivos iniciais propostos)</font>.<BR>&';
array_push($cp, array('$R ' . $opc, 'pp_abe_05', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_06', $comentarios, False, True));
$comentarios = 'Coment�rios sobre sua avalia��o deste item caso tenha assinalado as alternativas ruim:';

/** Quarta quest�o **/
$cap = $sp . '4) Resultados parciais obtidos:';
$opc = 'Excelente';
$opc .= ':Excelente' . $ccor . ' (resultados parciais altamente relevantes para o prosseguimento das atividades).</font><BR>&';
$opc .= 'Bom';
$opc .= ':Bom' . $ccor . ' (dados obtidos s�o adequados, bem como a an�lise preliminar. Na pr�xima etapa deve haver complementa��o e aprofundamento)</font>.<BR>&';
$opc .= 'Regular';
$opc .= ':Regular' . $ccor . ' (dados obtidos n�o foram analisados, dificultando a avalia��o da sua relev�ncia no contexto do projeto)</font>.<BR>&';
$opc .= 'Ruim';
$opc .= ':Ruim' . $ccor . ' (poucos ou nenhum resultado relevante no contexto do projeto foram apresentados)</font>.<BR>&';
$opc .= 'N�o se aplica';
$opc .= ':N�o se aplica' . $ccor . ' (de acordo com o cronograma inicial apresentado, n�o � esperado a apresenta��o de resultados nesta etapa do trabalho)</font>.<BR>&';
$comentarios = 'Coment�rios sobre sua avalia��o deste item, caso tenha assinalado as alternativas regular ou ruim:';
array_push($cp, array('$R ' . $opc, 'pp_abe_07', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_08', $comentarios, False, True));

/** Quinta quest�o **/
$cap = $sp . '5)	No caso desta pesquisa de IC ser parte de uma pesquisa de mestrado, doutorado ou parte de projeto  mais amplo, assinale se:';
$opc = 'as atividades descritas n�o est�o adequadas para uma proposta de IC (obrigat�ria 	a modifica��o, ver justificativa).';
$opc .= ': as atividades descritas n�o est�o adequadas para uma proposta de IC (obrigat�ria a modifica��o, ver justificativa).<BR>&';
$opc .= ' as atividades descritas s�o parcialmente v�lidas para IC ( sugerir modifica��es na justificativa).';
$opc .= ': as atividades descritas s�o parcialmente v�lidas para IC ( sugerir modifica��es na justificativa).<BR>&';
$opc .= ' as atividades descritas s�o adequadas para IC.';
$opc .= ':as atividades descritas s�o adequadas para IC.<BR>&';
$opc .= 'n�o se aplica: n�o se aplica.';
$comentarios = 'Coment�rios sobre sua avalia��o deste item caso tenha assinalado as alternativas de "n�o est�o adequadas" ou "parcialmente":';
array_push($cp, array('$R ' . $opc, 'pp_abe_11', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_12', $comentarios, False, True));

/** Sexta quest�o **/
$cap = $sp . '<B>6) O relat�rio parcial apresenta graves problemas relacionados a orienta��o desenvolvida e/ou problemas metodol�gicos que comprometem a forma��o do aluno de inicia��o cient�fica. Indique tais problemas no campo de coment�rios restrito. O avaliador considera que deve ser realizada uma reuni�o com o professor orientador?';
$opc = 'N�O:N�O<BR>&';
$opc .= 'SIM:SIM';
$comentarios = 'Coment�rios sobre a descri��o dos problemas (item restrito ao comit� gestor)';
array_push($cp, array('$R ' . $opc, 'pp_abe_14', $cap, True, True));
array_push($cp, array('$T80:4', 'pp_abe_16', $comentarios, False, True));

/** S�tima Quest�o **/
$cap = $sp . '<B>7) Outros coment�rios (o avaliador fica livre para suas sugest�es e coment�rios sobre a aprecia��o geral do trabalho)</B><BR>.';
array_push($cp, array('$T80:8', 'pp_abe_13', $cap, True, True));

if (strlen($ceua_s1 . $cep_s1) > 0) {
	/** Quest�o quatro **/
	$cap = $sp . '8) <B>Comit� de �tica em Pesquisa - O projeto de pesquisa envolve participa��o individual ou coletivamente,
seres humano ou animais em seus experimentos, sendo necess�rio avalia��o dos Comit�s de �tica da PUCPR/PR ?</B><BR>.';

	$s = 'N�o apresentou o protocolo de aprova��o';
	$ope .= $s . ':' . $s . '<BR>';

	$s = 'Foi aprovado pelo Comit� de �tica';
	$ope .= '&' . $s . ':' . $s . '<BR>';

	array_push($cp, array('$R ' . $ope, 'pp_abe_09', $cap, True, True));
} else {
	$cap = $sp . '8) <B>Comit� de �tica em Pesquisa - O projeto de pesquisa envolve participa��o individual ou coletivamente,
seres humano ou animais em seus experimentos, sendo necess�rio avalia��o dos Comit�s de �tica da PUCPR/PR ?</B><BR>.';

	$s = 'N�o necessita passar pelos Comit�s de �tica (n�o se aplica)';
	array_push($cp, array('$HV', 'pp_abe_09', $s, True, True));
	
}

/** Oitava Quest�o **/
$cap = $sp . '9)	Resultado da avalia��o:';
$opc = '1:<font color=Green>Aprovado - coment�rios e sugest�es devem ser incorporados no relat�rio final</font><BR>&';
$opc .= '2:<font color=red>Pend�ncias - relat�rio parcial deve ser reapresentado realizando as devidas corre��es</font>';
array_push($cp, array('$R ' . $opc, 'pp_p01', $cap, True, True));


$nota = ' :Nota';
for ($r = 0; $r <= 10; $r = $r + 0.5) {
	$nota .= '&' . $r . ':' . number_format($r, 1);
}

array_push($cp, array('$M', '', 'Atribuia uma nota de 0 a 10 para o trabalho no geral', False, True));
array_push($cp, array('$O ' . $nota, 'pp_abe_15', 'Nota', True, True));

array_push($cp, array('$B8', '', 'Finaliza avalia��o >>', False, True));
?>