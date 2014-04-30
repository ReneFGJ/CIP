<?php
$cp = array();
array_push($cp,array('$H8','id_pp','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$H8','','',False,True));

/** Tabela **/
$tabela = $parecer->tabela;

/** Data, hora e estatus da avaliavcao **/
array_push($cp,array('$HV','pp_parecer_data',date('Yms'),False,True));
array_push($cp,array('$HV','pp_parecer_hora',date('H:m'),False,True));
array_push($cp,array('$HV','pp_status','B',False,True));
$ccor = '<font color=blue >';

/** Primeira quest�o **/
$cap = "1) Clareza, legibilidade e objetividade (portugu�s, organiza��o geral do texto, figuras, gr�ficos, tabelas, refer�ncias, etc.):";
$opc  = 'Excelente:Excelente<BR>&';
$opc .= 'Bom:Bom<BR>&';
$opc .= 'Regular. Muitas corre��es s�o necess�rias.</font>.:Regular. Muitas corre��es s�o necess�rias '.$ccor.'(especific�-las nos coment�rios)</font>.<BR>&';
$opc .= 'Ruim. O relat�rio precisa ser refeito.:Ruim. O relat�rio precisa ser refeito '.$ccor.'(comentar)</font>.';
array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_02',$comentarios,False,True));

/** Segunda Quest�o **/
$cap = $sp.'2) Cumprimento do cronograma previsto:';
$opc  = 'Excelente. As atividades est�o sendo feitas dentro do cronograma previsto.:Excelente. As atividades est�o sendo feitas dentro do cronograma previsto.<BR>&';
$opc .= 'Bom. A maior parte das atividades previstas foram cumpridas. O cumprimento integral dos objetivos propostos nos meses restantes � plenamente vi�vel.:Bom. A maior parte das atividades previstas foram cumpridas. O cumprimento integral dos objetivos propostos nos meses restantes � plenamente vi�vel.<BR>&';
$opc .= 'Houve algumas mudan�as devidamente justificadas nos objetivos e no cronograma inicialmente previstos.:Houve algumas mudan�as devidamente justificadas nos objetivos e no cronograma inicialmente previstos.<BR>&';
$opc .= 'Regular. Importante atraso no cronograma que poder� comprometer o cumprimento dos objetivos iniciais propostos.:Regular. Importante atraso no cronograma que poder� comprometer o cumprimento dos objetivos iniciais propostos. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Ruim. Severo atraso no cronograma ou mudan�a n�o justificada, ou n�o apropriada nos objetivos e no cronograma inicialmente propostos.:Ruim. Severo atraso no cronograma ou mudan�a n�o justificada, ou n�o apropriada nos objetivos e no cronograma inicialmente propostos. '.$ccor.'(Comentar)</font><BR>';
array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_04',$comentarios,False,True));

/** Terceira quest�o **/

$cap = $sp.'3) Resultados parciais obtidos:';
$opc  = 'Altamente relevantes para prosseguimento das atividades.:Altamente relevantes para prosseguimento das atividades.<BR>&';
$opc .= 'As conclus�es extra�das dos dados obtidos s�o satisfat�rias.:As conclus�es extra�das dos dados obtidos s�o satisfat�rias.<BR>&';
$opc .= 'Mais conclus�es sobre os dados apresentados s�o necess�rias.:Mais conclus�es sobre os dados apresentados s�o necess�rias. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Regulares. Dados obtidos n�o s�o analisados dificultando a avalia��o da sua relev�ncia no contexto do projeto.:Regulares. Dados obtidos n�o s�o analisados dificultando a avalia��o da sua relev�ncia no contexto do projeto. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados.:Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados. '.$ccor.'(Comentar)</font><BR>&';
array_push($cp,array('$R '.$opc,'pp_abe_05',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_06',$comentarios,False,True));

/** Quest�o quatro **/
$cap = $sp.'<B>4) Coment�rios sobre a avalia��o</B><BR>(Justifique aqui as op��es marcadas acima, fazendo as sugest�es que julgar adequadas para melhorar a qualidade do relat�rio apresentado e fazendo sua aprecia��o geral do trabalho).';
array_push($cp,array('$T80:8','pp_abe_07',$cap,True,True));

/** Quita Quest�o **/
$cap = $sp.'5) Resultado da avalia��o:';
$opc  = '1:<font color=Green>Aprovado</font><BR>&';
$opc .= '2:<font color=red>N�o aprovado, precisa ser refeito.</font>';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));

array_push($cp,array('$B8','','Finaliza avalia��o >>',False,True));
?>