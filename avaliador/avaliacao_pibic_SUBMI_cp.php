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
$cap = "1) 1)	As corre��es solicitadas foram realizadas?:";
$opc  = 'sim, integralmente:';
 $opc .= ':sim, integralmente.<BR>&';
$opc .= 'sim, parcialmente';
 $opc .= ':sim, parcialmente<BR>&';
$opc .= 'n�o';
 $opc .= ':n�o<BR>';

 array_push($cp,array('$H8','id_pp','',True,True));
array_push($cp,array('$R '.$opc,'pp_abe_01',$cap,True,True));

/** Segunda Quest�o **/
$cap = $sp.'2) Em caso negativo, indique o que n�o foi corrigido:';
array_push($cp,array('$T80:4','pp_abe_02',$cap,False,True));

$cap = $sp.'3)	Os itens descritos na quest�o 2 (se aplic�vel) poder�o ser corrigidos no relat�rio final?';
$opc  = 'sim:sim<BR>';
$opc  .= '&n�o:n�o<BR>';
$opc  .= '&n�o aplic�vel:n�o aplic�vel<BR>';
array_push($cp,array('$R '.$opc,'pp_abe_03',$cap,True,True));

$cap = $sp.'4)	O avaliador considera que o projeto deve ser cancelado em fun��o do n�o cumprimento das corre��es indicadas?';
$opc  = 'sim, projeto encaminhado ao comit� gestor:sim, projeto encaminhado ao comit� gestor<BR>';
$opc  .= '&n�o:n�o <BR>';
array_push($cp,array('$R '.$opc,'pp_abe_04',$cap,True,True));

/** Quita Quest�o **/
$cap = $sp.'9) Resultado da reavalia��o:';
$opc  = '1:<font color=Green>Aprovado</font><BR>&';
$opc .= '2:<font color=red>Pend�ncias - relat�rio parcial ainda precisa ser corrigido para o relat�rio final.</font>';
array_push($cp,array('$R '.$opc,'pp_p01',$cap,True,True));
//array_push($cp,array('$HV','pp_p02','1',True,True));
//array_push($cp,array('$HV','','1',True,True));

array_push($cp,array('$B8','','Finaliza avalia��o >>',False,True));

?>