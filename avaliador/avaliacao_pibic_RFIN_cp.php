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
$cap = "1) Clareza, legibilidade e objetividade (portugu�s, organiza��o geral do texto, figuras, gr�ficos, tabelas, refer�ncias, etc.):";
$opc  = 'Excelente:';
 $opc .= ':Excelente.<BR>&';
$opc .= 'Bom';
 $opc .= ':Bom. <BR>&';
$opc .= 'Regular';
 $opc .= ':Regular. Muitas corre��es s�o necess�rias. '.$ccor.'(obrigat�rio especificar as corre��es a serem realizadas).</font>.<BR>&';
$opc .= 'Ruim';
 $opc .= ':Ruim. O relat�rio precisa ser refeito. '.$ccor.'(obrigat�rio detalhar)</font>.';
array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_02',$comentarios,False,True));

/** Segunda Quest�o **/
$cap = $sp.'2) Cumprimento do cronograma previsto:';
$opc  = 'Excelente:Excelente<BR>&';
$opc .= 'Bom:Bom<BR>&';
$opc .= 'Houve algumas mudan�as devidamente justificadas nos objetivos e no cronograma inicialmente previstos:Houve algumas mudan�as devidamente justificadas nos objetivos e no cronograma inicialmente previstos.<BR>&';
$opc .= 'Regular. Importante atraso no cronograma que comprometeu o cumprimento dos objetivos iniciais propostos.:Regular. Importante atraso no cronograma que comprometeu o cumprimento dos objetivos iniciais propostos. <font color="blue">(obrigat�rio detalhar)</font>.<BR>&';
$opc .= ' Ruim. Severo atraso no cronograma ou mudan�a n�o justificada, ou n�o apropriada nos objetivos e no cronograma inicialmente propostos.: Ruim. Severo atraso no cronograma ou mudan�a n�o justificada, ou n�o apropriada nos objetivos e no cronograma inicialmente propostos. <font color="blue">(obrigat�rio detalhar)</font><BR>';
array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_04',$comentarios,False,True));


$cap = $sp.'3) Resultados finais obtidos:';
$opc  = 'Altamente relevantes para prosseguimento das atividades. As conclus�es extra�das dos dados obtidos s�o satisfat�rias.:Altamente relevantes para prosseguimento das atividades. As conclus�es extra�das dos dados obtidos s�o satisfat�rias.<BR>&';
$opc .= 'Bons:Bons.<BR>&';
$opc .= 'Regulares. Dados obtidos n�o est�o analisados, dificultando a avalia��o da sua relev�ncia no contexto do projeto.:Regulares. Dados obtidos n�o est�o analisados, dificultando a avalia��o da sua relev�ncia no contexto do projeto. '.$ccor.'(Comentar)</font><BR>&';
$opc .= 'Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados:Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados. '.$ccor.'(Comentar)</font><BR>';
array_push($cp,array('$R '.$opc,'pp_abe_05',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_06',$comentarios,False,True));

array_push($cp,array('$A','','Sobre o Resumo',False,True));

/** Quarta quest�o **/
$cap = $sp.'4) Clareza, legibilidade e objetividade (digita��o, portugu�s e organiza��o geral):';
$opc  = 'Excelente:Excelente.<BR>&';
$opc .= 'Bom:Bom.<BR>&';
$opc .= 'Regular. Muitas corre��es s�o necess�rias:Regular. Muitas corre��es s�o necess�rias '.$ccor.'(Obrigat�rio especific�-las nos coment�rios)</font>.<BR>&';
$opc .= 'Ruim. O RESUMO precisa ser refeito :Ruim. O RESUMO precisa ser refeito<font color="blue"> (Comentar)</font><BR>&';
array_push($cp,array('$R '.$opc,'pp_abe_07',$cap,True,True));
//array_push($cp,array('$T80:4','pp_abe_08',$comentarios,False,True));

/** Terceira quest�o **/
$texto = mst('<BR>
<font class="lt1">
<BR>- Justifique aqui as op��es marcadas acima, fazendo as sugest�es que julgar adequadas para melhorar a qualidade do relat�rio apresentado e fazendo sua aprecia��o geral do trabalho. 
<BR>- M�nimo de 60 palavras, detalhamento obrigat�rio se as alternativas assinaladas foram regular ou ruim.
</font>
');

array_push($cp,array('$A','','Sobre o projeto em Geral',False,True));

$cap = $sp.'5) Coment�rios sobre a avalia��o  (obrigat�rio):';
array_push($cp,array('$T80:4','pp_abe_09',$cap.$texto,True,True));


/** Quita Quest�o **/

$cap = $sp.'6) Resultado da avalia��o do Relat�rio Final e do Resumo';
$opc = '20:Relat�rio Final aprovado com M�rito.<BR>&';
$opc .= '10:Relat�rio Final aprovado.<BR>&';
//$opc .= '12:<font color=Green>Aprovado com pend�ncias a serem corrigidas<font><BR>&';
$opc .= '5:Aprovado, por�m necessita adequa��es para apreseta��o no SEMIC.<BR>&';
$opc .= '2:Relat�rio Final est� com pend�ncias, precisa ser corrigido e reenviado.<BR>&';
$opc .= '-1:Relat�rio n�o aprovado e n�o indicado para apresenta��o p�blica no XXI SEMIC.';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));
//array_push($cp,array('$HV','pp_p02','1',True,True));
//array_push($cp,array('$HV','','1',True,True));

$cap = $sp.'7) Apresente justificativa detalhada, m�nimo de 60 palavras, caso o trabalho n�o tenha sido indicado para apresenta��o p�blica no XXI do SEMIC:';
array_push($cp,array('$T80:4','pp_abe_10',$cap,False,True));


array_push($cp,array('$B8','','Finaliza avalia��o >>',False,True));

?>