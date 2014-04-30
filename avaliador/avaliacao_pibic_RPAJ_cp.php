<?php
$cp = array();
array_push($cp,array('$H8','id_pp','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));

/** Tabela **/
$tabela = 'pibic_parecer_'.date("Y");

/** Data, hora e estatus da avaliavcao **/
array_push($cp,array('$HV','pp_parecer_data',date('Yms'),False,True));
array_push($cp,array('$HV','pp_parecer_hora',date('H:m'),False,True));
array_push($cp,array('$HV','pp_status','@',False,True));
$ccor = '<font color=blue >';

/** Primeira questão **/
$cap = "1) 1)	Clareza, legibilidade e objetividade (português, organização geral do texto, figuras, gráficos, tabelas, referências, adequação do relatório ao modelo do Programa):";
$opc  = 'Excelente';
 $opc .= ': Excelente.<BR>&';
$opc .= 'Bom';
 $opc .= ':Bom.<BR>&';
$opc .= 'Regular';
 $opc .= ':Regular. '.$ccor.'(muitas correções são necessárias, assinalar no campo dos comentários ).</font>.<BR>&';
$opc .= 'Ruim';
 $opc .= ':Ruim. '.$ccor.'(o relatório precisa ser refeito)</font>.';
array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_02',$comentarios,False,True));

/** Segunda Questão **/
$cap = $sp.'2)	Na estruturação do relatório, os itens: introdução, objetivo(s), desenvolvimento e  metodologia, resultados parciais estão apresentados adequadamente, bem como, mantêm relação coerente entre si. Neste ponto este relatório está:';
$opc  = 'adequado:adequado<BR>&';
$opc  .= 'parcialmente adequado:parcialmente adequado<BR>&';
$opc  .= 'inadequado:inadequado';

array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_04',$comentarios,False,True));

$cap = $sp.'3) Cumprimento do plano de trabalho previsto:';
$comentarios = 'Comentários sobre sua avaliação deste item caso tenha assinalado as alternativas ruim:';
$opc  = 'Bom';
	$opc .= ':Bom.<BR>&';
$opc .= 'Regular (a maior parte das atividades previstas foram cumpridas. Houve algumas mudanças nos objetivos e/ou planejamento, as quais foram devidamente justificadas)';
	$opc .= ':Regular (a maior parte das atividades previstas foram cumpridas. Houve algumas mudanças nos objetivos e/ou planejamento, as quais foram devidamente justificadas).<BR>&';
$opc .= 'Ruim (importante atraso no plano de trabalho que poderá comprometer o cumprimento dos objetivos inicias propostos. Há necessidade de ajuste no cronograma e/ou objetivos do projeto. Justificativas devem ser apresentadas )';
	$opc .= ':Ruim (importante atraso no plano de trabalho que poderá comprometer o cumprimento dos objetivos inicias propostos. Há necessidade de ajuste no cronograma e/ou objetivos do projeto. Justificativas devem ser apresentadas ).<BR>&';
	array_push($cp,array('$R '.$opc,'pp_abe_05',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_06',$comentarios,False,True));


/** Terceira questão **/

$cap = $sp.'4) Resultados parciais obtidos:';
$opc  = 'Excelente, resultados parciais altamente relevantes para o prosseguimento das atividades:Excelente '.$ccor.'(resultados parciais altamente relevantes para o prosseguimento das atividades)</font>.<BR>&';
$opc  .= 'Bom, dados obtidos são adequados, bem como a análise preliminar. Na próxima etapa deve haver complementação e aprofundamento:Bom '.$ccor.'(dados obtidos são adequados, bem como a análise preliminar. Na próxima etapa deve haver complementação e aprofundamento)</font>.<BR>&';
$opc  .= 'Regular:Regular Regular, dados obtidos não foram analisados, dificultando a avaliação da sua relevância no contexto do projeto '.$ccor.'(dados obtidos não foram analisados, dificultando a avaliação da sua relevância no contexto do projeto)</font>.<BR>&';
$opc  .= 'Ruim, poucos ou nenhum resultado relevante no contexto do projeto foram apresentados:Ruim. '.$ccor.'(poucos ou nenhum resultado relevante no contexto do projeto foram apresentados)</font>.<BR>&';
$opc  .= 'Não se aplica: Não se aplica '.$ccor.'(de acordo com o cronograma inicial apresentado, não é esperado a apresentação de resultados nesta etapa do trabalho)</font>.<BR>&';
$comentarios = 'Comentários sobre sua avaliação deste item, caso tenha assinalado as alternativas regular ou ruim:';
array_push($cp,array('$R '.$opc,'pp_abe_07',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_08',$comentarios,False,True));

/** Terceira questão **/

$cap = $sp.'5) No caso desta pesquisa de IC ser parte de uma pesquisa de mestrado, doutorado ou parte de projeto  mais amplo, assinale se:';
$opc  = 'Bom, as atividades descritas são adequadas para a formação do aluno de IC Jr.';
	$opc  .= ': Bom, as atividades descritas são adequadas para a formação do aluno de IC Jr. .<BR>&';
$opc  .= 'Regular, as atividades descritas são parcialmente válidas para IC Jr.';
	$opc  .= ': Regular, as atividades descritas são parcialmente válidas para IC Jr (sugerir modificações  na justificativa).<BR>&';
$opc  .= 'Ruim, as atividades descritas não estão adequadas para uma proposta de IC  Jr.';
	$opc  .= ': Ruim, as atividades descritas não estão adequadas para uma proposta de IC  Jr (obrigatória a modificação, ver justificativa)<BR>&';
$opc  .= 'não se aplica: não se aplica.';
array_push($cp,array('$R '.$opc,'pp_abe_11',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_12','6) '.$comentarios,True,True));

$cap = $sp.'<B>6) O relatório parcial apresenta graves problemas relacionados a orientação desenvolvida e/ou problemas metodológicos que comprometem a formação do aluno de iniciação científica júnior. Indique tais problemas no campo de comentários restrito. O avaliador considera que deve ser realizada uma reunião com o professor orientador?';
$opc = 'NÃO:NÃO<BR>&';
$opc .= 'SIM:SIM';

array_push($cp,array('$R '.$opc,'pp_abe_14',$cap,True,True));

/** Questão quatro **/
$cap = $sp.'<B>7) Comentários restritos: (o avaliador fica livre para suas sugestões e comentários sobre a apreciação geral do trabalho)<BR>.';
array_push($cp,array('$T80:8','pp_abe_15',$cap,True,True));

/** Quita Questão **/
$cap = $sp.'8) Resultado da avaliação:';
$opc  = '1:<font color=Green>Aprovado - comentários e sugestões devem ser incorporados no relatório final</font><BR>&';
$opc .= '2:<font color=red>Pendências - relatório parcial deve ser reapresentado realizando as devidas correções.</font>';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));
//array_push($cp,array('$HV','pp_p02','1',True,True));
//array_push($cp,array('$HV','','1',True,True));

array_push($cp,array('$B8','','Finaliza avaliação >>',False,True));

?>