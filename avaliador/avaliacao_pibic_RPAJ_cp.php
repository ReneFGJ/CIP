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

/** Primeira quest�o **/
$cap = "1) 1)	Clareza, legibilidade e objetividade (portugu�s, organiza��o geral do texto, figuras, gr�ficos, tabelas, refer�ncias, adequa��o do relat�rio ao modelo do Programa):";
$opc  = 'Excelente';
 $opc .= ': Excelente.<BR>&';
$opc .= 'Bom';
 $opc .= ':Bom.<BR>&';
$opc .= 'Regular';
 $opc .= ':Regular. '.$ccor.'(muitas corre��es s�o necess�rias, assinalar no campo dos coment�rios ).</font>.<BR>&';
$opc .= 'Ruim';
 $opc .= ':Ruim. '.$ccor.'(o relat�rio precisa ser refeito)</font>.';
array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_02',$comentarios,False,True));

/** Segunda Quest�o **/
$cap = $sp.'2)	Na estrutura��o do relat�rio, os itens: introdu��o, objetivo(s), desenvolvimento e  metodologia, resultados parciais est�o apresentados adequadamente, bem como, mant�m rela��o coerente entre si. Neste ponto este relat�rio est�:';
$opc  = 'adequado:adequado<BR>&';
$opc  .= 'parcialmente adequado:parcialmente adequado<BR>&';
$opc  .= 'inadequado:inadequado';

array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_04',$comentarios,False,True));

$cap = $sp.'3) Cumprimento do plano de trabalho previsto:';
$comentarios = 'Coment�rios sobre sua avalia��o deste item caso tenha assinalado as alternativas ruim:';
$opc  = 'Bom';
	$opc .= ':Bom.<BR>&';
$opc .= 'Regular (a maior parte das atividades previstas foram cumpridas. Houve algumas mudan�as nos objetivos e/ou planejamento, as quais foram devidamente justificadas)';
	$opc .= ':Regular (a maior parte das atividades previstas foram cumpridas. Houve algumas mudan�as nos objetivos e/ou planejamento, as quais foram devidamente justificadas).<BR>&';
$opc .= 'Ruim (importante atraso no plano de trabalho que poder� comprometer o cumprimento dos objetivos inicias propostos. H� necessidade de ajuste no cronograma e/ou objetivos do projeto. Justificativas devem ser apresentadas )';
	$opc .= ':Ruim (importante atraso no plano de trabalho que poder� comprometer o cumprimento dos objetivos inicias propostos. H� necessidade de ajuste no cronograma e/ou objetivos do projeto. Justificativas devem ser apresentadas ).<BR>&';
	array_push($cp,array('$R '.$opc,'pp_abe_05',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_06',$comentarios,False,True));


/** Terceira quest�o **/

$cap = $sp.'4) Resultados parciais obtidos:';
$opc  = 'Excelente, resultados parciais altamente relevantes para o prosseguimento das atividades:Excelente '.$ccor.'(resultados parciais altamente relevantes para o prosseguimento das atividades)</font>.<BR>&';
$opc  .= 'Bom, dados obtidos s�o adequados, bem como a an�lise preliminar. Na pr�xima etapa deve haver complementa��o e aprofundamento:Bom '.$ccor.'(dados obtidos s�o adequados, bem como a an�lise preliminar. Na pr�xima etapa deve haver complementa��o e aprofundamento)</font>.<BR>&';
$opc  .= 'Regular:Regular Regular, dados obtidos n�o foram analisados, dificultando a avalia��o da sua relev�ncia no contexto do projeto '.$ccor.'(dados obtidos n�o foram analisados, dificultando a avalia��o da sua relev�ncia no contexto do projeto)</font>.<BR>&';
$opc  .= 'Ruim, poucos ou nenhum resultado relevante no contexto do projeto foram apresentados:Ruim. '.$ccor.'(poucos ou nenhum resultado relevante no contexto do projeto foram apresentados)</font>.<BR>&';
$opc  .= 'N�o se aplica: N�o se aplica '.$ccor.'(de acordo com o cronograma inicial apresentado, n�o � esperado a apresenta��o de resultados nesta etapa do trabalho)</font>.<BR>&';
$comentarios = 'Coment�rios sobre sua avalia��o deste item, caso tenha assinalado as alternativas regular ou ruim:';
array_push($cp,array('$R '.$opc,'pp_abe_07',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_08',$comentarios,False,True));

/** Terceira quest�o **/

$cap = $sp.'5) No caso desta pesquisa de IC ser parte de uma pesquisa de mestrado, doutorado ou parte de projeto  mais amplo, assinale se:';
$opc  = 'Bom, as atividades descritas s�o adequadas para a forma��o do aluno de IC Jr.';
	$opc  .= ': Bom, as atividades descritas s�o adequadas para a forma��o do aluno de IC Jr. .<BR>&';
$opc  .= 'Regular, as atividades descritas s�o parcialmente v�lidas para IC Jr.';
	$opc  .= ': Regular, as atividades descritas s�o parcialmente v�lidas para IC Jr (sugerir modifica��es  na justificativa).<BR>&';
$opc  .= 'Ruim, as atividades descritas n�o est�o adequadas para uma proposta de IC  Jr.';
	$opc  .= ': Ruim, as atividades descritas n�o est�o adequadas para uma proposta de IC  Jr (obrigat�ria a modifica��o, ver justificativa)<BR>&';
$opc  .= 'n�o se aplica: n�o se aplica.';
array_push($cp,array('$R '.$opc,'pp_abe_11',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_12','6) '.$comentarios,True,True));

$cap = $sp.'<B>6) O relat�rio parcial apresenta graves problemas relacionados a orienta��o desenvolvida e/ou problemas metodol�gicos que comprometem a forma��o do aluno de inicia��o cient�fica j�nior. Indique tais problemas no campo de coment�rios restrito. O avaliador considera que deve ser realizada uma reuni�o com o professor orientador?';
$opc = 'N�O:N�O<BR>&';
$opc .= 'SIM:SIM';

array_push($cp,array('$R '.$opc,'pp_abe_14',$cap,True,True));

/** Quest�o quatro **/
$cap = $sp.'<B>7) Coment�rios restritos: (o avaliador fica livre para suas sugest�es e coment�rios sobre a aprecia��o geral do trabalho)<BR>.';
array_push($cp,array('$T80:8','pp_abe_15',$cap,True,True));

/** Quita Quest�o **/
$cap = $sp.'8) Resultado da avalia��o:';
$opc  = '1:<font color=Green>Aprovado - coment�rios e sugest�es devem ser incorporados no relat�rio final</font><BR>&';
$opc .= '2:<font color=red>Pend�ncias - relat�rio parcial deve ser reapresentado realizando as devidas corre��es.</font>';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));
//array_push($cp,array('$HV','pp_p02','1',True,True));
//array_push($cp,array('$HV','','1',True,True));

array_push($cp,array('$B8','','Finaliza avalia��o >>',False,True));

?>