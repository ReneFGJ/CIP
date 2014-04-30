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
$cap = "1) Clareza, legibilidade e objetividade (português, organização geral do texto, figuras, gráficos, tabelas, referências, etc.):";
$opc  = 'Excelente:';
 $opc .= ':Excelente.<BR>&';
$opc .= 'Bom';
 $opc .= ':Bom. <BR>&';
$opc .= 'Regular';
 $opc .= ':Regular. Muitas correções são necessárias. '.$ccor.'(obrigatório especificar as correções a serem realizadas).</font>.<BR>&';
$opc .= 'Ruim';
 $opc .= ':Ruim. O relatório precisa ser refeito. '.$ccor.'(obrigatório detalhar)</font>.';
array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_02',$comentarios,False,True));

/** Segunda Questão **/
$cap = $sp.'2) Cumprimento do cronograma previsto:';
$opc  = 'Excelente:Excelente<BR>&';
$opc .= 'Bom:Bom<BR>&';
$opc .= 'Houve algumas mudanças devidamente justificadas nos objetivos e no cronograma inicialmente previstos:Houve algumas mudanças devidamente justificadas nos objetivos e no cronograma inicialmente previstos.<BR>&';
$opc .= 'Regular. Importante atraso no cronograma que comprometeu o cumprimento dos objetivos iniciais propostos.:Regular. Importante atraso no cronograma que comprometeu o cumprimento dos objetivos iniciais propostos. <font color="blue">(obrigatório detalhar)</font>.<BR>&';
$opc .= ' Ruim. Severo atraso no cronograma ou mudança não justificada, ou não apropriada nos objetivos e no cronograma inicialmente propostos.: Ruim. Severo atraso no cronograma ou mudança não justificada, ou não apropriada nos objetivos e no cronograma inicialmente propostos. <font color="blue">(obrigatório detalhar)</font><BR>';
array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_04',$comentarios,False,True));


$cap = $sp.'3) Resultados finais obtidos:';
$opc  = 'Altamente relevantes para prosseguimento das atividades. As conclusões extraídas dos dados obtidos são satisfatórias.:Altamente relevantes para prosseguimento das atividades. As conclusões extraídas dos dados obtidos são satisfatórias.<BR>&';
$opc .= 'Bons:Bons.<BR>&';
$opc .= 'Regulares. Dados obtidos não estão analisados, dificultando a avaliação da sua relevância no contexto do projeto.:Regulares. Dados obtidos não estão analisados, dificultando a avaliação da sua relevância no contexto do projeto. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados:Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados. '.$ccor.'(Comentar)</font><BR>';
array_push($cp,array('$R '.$opc,'pp_abe_05',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_06',$comentarios,False,True));

array_push($cp,array('$A','','Sobre o Resumo',False,True));

/** Quarta questão **/
$cap = $sp.'4) Clareza, legibilidade e objetividade (digitação, português e organização geral):';
$opc  = 'Excelente:Excelente.<BR>&';
$opc .= 'Bom:Bom.<BR>&';
$opc .= 'Regular. Muitas correções são necessárias:Regular. Muitas correções são necessárias '.$ccor.'(Obrigatório especificá-las nos comentários)</font>.<BR>&';
$opc .= 'Ruim. O RESUMO precisa ser refeito :Ruim. O RESUMO precisa ser refeito<font color="blue"> (Comentar)</font><BR>&';
array_push($cp,array('$R '.$opc,'pp_abe_07',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_08',$comentarios,False,True));

/** Terceira questão **/
$texto = mst('<BR>
<font class="lt1">
<BR>- Justifique aqui as opções marcadas acima, fazendo as sugestões que julgar adequadas para melhorar a qualidade do relatório apresentado e fazendo sua apreciação geral do trabalho. 
<BR>- Mínimo de 60 palavras, detalhamento obrigatório se as alternativas assinaladas foram regular ou ruim.
</font>
');

array_push($cp,array('$A','','Sobre o projeto em Geral',False,True));

$cap = $sp.'5) Comentários sobre a avaliação  (obrigatório):';
array_push($cp,array('$T80:4','pp_abe_09',$cap.$texto,True,True));


/** Quita Questão **/

$cap = $sp.'6) Resultado da avaliação do Relatório Final e do Resumo';
$opc = '20:Relatório Final aprovado com Mérito.<BR>&';
$opc .= '10:Relatório Final aprovado.<BR>&';
//$opc .= '12:<font color=Green>Aprovado com pendências a serem corrigidas<font><BR>&';
$opc .= '5:Aprovado, porém necessita adequações para apresetação no SEMIC.<BR>&';
$opc .= '2:Relatório Final está com pendências, precisa ser corrigido e reenviado.<BR>&';
$opc .= '-1:Relatório não aprovado e não indicado para apresentação pública no XXI SEMIC.';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));
//array_push($cp,array('$HV','pp_p02','1',True,True));
//array_push($cp,array('$HV','','1',True,True));

$cap = $sp.'7) Apresente justificativa detalhada, mínimo de 60 palavras, caso o trabalho não tenha sido indicado para apresentação pública no XXI do SEMIC:';
array_push($cp,array('$T80:4','pp_abe_10',$cap,False,True));


array_push($cp,array('$B8','','Finaliza avaliação >>',False,True));

?>