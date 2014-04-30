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

/** Primeira questão **/
$cap = "1) Clareza, legibilidade e objetividade (português, organização geral do texto, figuras, gráficos, tabelas, referências, etc.):";
$opc  = 'Excelente:Excelente<BR>&';
$opc .= 'Bom:Bom<BR>&';
$opc .= 'Regular. Muitas correções são necessárias.</font>.:Regular. Muitas correções são necessárias '.$ccor.'(especificá-las nos comentários)</font>.<BR>&';
$opc .= 'Ruim. O relatório precisa ser refeito.:Ruim. O relatório precisa ser refeito '.$ccor.'(comentar)</font>.';
array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_02',$comentarios,False,True));

/** Segunda Questão **/
$cap = $sp.'2) Cumprimento do cronograma previsto:';
$opc  = 'Excelente. As atividades estão sendo feitas dentro do cronograma previsto.:Excelente. As atividades estão sendo feitas dentro do cronograma previsto.<BR>&';
$opc .= 'Bom. A maior parte das atividades previstas foram cumpridas. O cumprimento integral dos objetivos propostos nos meses restantes é plenamente viável.:Bom. A maior parte das atividades previstas foram cumpridas. O cumprimento integral dos objetivos propostos nos meses restantes é plenamente viável.<BR>&';
$opc .= 'Houve algumas mudanças devidamente justificadas nos objetivos e no cronograma inicialmente previstos.:Houve algumas mudanças devidamente justificadas nos objetivos e no cronograma inicialmente previstos.<BR>&';
$opc .= 'Regular. Importante atraso no cronograma que poderá comprometer o cumprimento dos objetivos iniciais propostos.:Regular. Importante atraso no cronograma que poderá comprometer o cumprimento dos objetivos iniciais propostos. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Ruim. Severo atraso no cronograma ou mudança não justificada, ou não apropriada nos objetivos e no cronograma inicialmente propostos.:Ruim. Severo atraso no cronograma ou mudança não justificada, ou não apropriada nos objetivos e no cronograma inicialmente propostos. '.$ccor.'(Comentar)</font><BR>';
array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_04',$comentarios,False,True));

/** Terceira questão **/

$cap = $sp.'3) Resultados parciais obtidos:';
$opc  = 'Altamente relevantes para prosseguimento das atividades.:Altamente relevantes para prosseguimento das atividades.<BR>&';
$opc .= 'As conclusões extraídas dos dados obtidos são satisfatórias.:As conclusões extraídas dos dados obtidos são satisfatórias.<BR>&';
$opc .= 'Mais conclusões sobre os dados apresentados são necessárias.:Mais conclusões sobre os dados apresentados são necessárias. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Regulares. Dados obtidos não são analisados dificultando a avaliação da sua relevância no contexto do projeto.:Regulares. Dados obtidos não são analisados dificultando a avaliação da sua relevância no contexto do projeto. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados.:Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados. '.$ccor.'(Comentar)</font><BR>&';
array_push($cp,array('$R '.$opc,'pp_abe_05',$cap,True,True));
array_push($cp,array('$T80:4','pp_abe_06',$comentarios,False,True));

/** Questão quatro **/
$cap = $sp.'<B>4) Comentários sobre a avaliação</B><BR>(Justifique aqui as opções marcadas acima, fazendo as sugestões que julgar adequadas para melhorar a qualidade do relatório apresentado e fazendo sua apreciação geral do trabalho).';
array_push($cp,array('$T80:8','pp_abe_07',$cap,True,True));

/** Quita Questão **/
$cap = $sp.'5) Resultado da avaliação:';
$opc  = '1:<font color=Green>Aprovado</font><BR>&';
$opc .= '2:<font color=red>Não aprovado, precisa ser refeito.</font>';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));

array_push($cp,array('$B8','','Finaliza avaliação >>',False,True));
?>